<?php

namespace Jimdo\JimFlow\EditBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jimdo\JimFlow\ImportBundle\Entity\Board;
use Jimdo\JimFlow\EditBoardBundle\Form\BoardType;
use Symfony\Component\HttpFoundation\Response;


/**
 * Board controller.
 *
 * @Route("/manage/board")
 */
class BoardController extends Controller
{
    /**
     * Lists all Board entities.
     *
     * @Route("/", name="manage_board")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('JimdoJimFlowImportBundle:Board')->findAllOrdered();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Board as print pdf.
     *
     * @Route("/{id}/print", name="manage_board_print")
     * @Template()
     */
    public function printAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JimdoJimFlowImportBundle:Board')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Board entity.');
        };

        $snappy = $this->get('snappy.pdf');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', sprintf('attachment;filename="qrcodes_board_%s.pdf"', $entity->getId()));

        $content = $this->renderView('JimdoJimFlowEditBoardBundle:Board:print.html.twig', array('entity' => $entity));

        $blub = $snappy->getOutputFromHtml($content);

        $response->setContent($blub);

        return $response;
    }


    /**
     * Displays a form to create a new Board entity.
     *
     * @Route("/new", name="manage_board_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Board();
        $form   = $this->createForm(new BoardType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Board entity.
     *
     * @Route("/create", name="manage_board_create")
     * @Method("post")
     * @Template("JimdoFlowEditBoardBundle:Board:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Board();
        $request = $this->getRequest();
        $form    = $this->createForm(new BoardType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manage_board_edit', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Board entity.
     *
     * @Route("/{id}/edit", name="manage_board_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JimdoJimFlowImportBundle:Board')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Board entity.');
        }

        $editForm = $this->createForm(new BoardType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Board entity.
     *
     * @Route("/{id}/update", name="manage_board_update")
     * @Method("post")
     * @Template("JimdoJimFlowEditBoardBundle:Board:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JimdoJimFlowImportBundle:Board')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Board entity.');
        }

        $editForm   = $this->createForm(new BoardType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manage_board_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Board entity.
     *
     * @Route("/{id}/delete", name="manage_board_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('JimdoJimFlowImportBundle:Board')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Board entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('manage_board'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
