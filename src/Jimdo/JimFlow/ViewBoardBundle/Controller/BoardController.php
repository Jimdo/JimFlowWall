<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jimdo\JimFlow\ImportBundle\Entity\Board;
use \Symfony\Component\HttpFoundation\Response;

class BoardController extends Controller
{
    /**
     * @Route("/board/detail/{boardId}", name="board_detail")
     * @Template()
     * @param $boardId
     * @return array
     */
    public function detailAction($boardId)
    {
        $em = $this->get('doctrine')->getEntityManager();

        $response = new Response();
        $response->setPublic();

        $newestSnapShot = $em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\SnapShot')->getNewestSnapShotByBoardId($boardId);

        $response->setETag(md5($newestSnapShot->getId() . $newestSnapShot->getCreatedAt()->format('Y-m-d H:i:s')));

        if ($response->isNotModified($this->get('request'))) {
            return $response;
        }

        $boards = $em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\Board')->findAll();

        $entityToViewMapper = $this->get('jimdo.entity_to_view_mapper');

        $snapShot = $entityToViewMapper->getSnapShotDetail($boardId);

        return $this->render(
            'JimdoJimFlowViewBoardBundle:Board:detail.html.twig',
            array('snapShot' => $snapShot, 'boards' => $boards),
            $response
        );
    }

}