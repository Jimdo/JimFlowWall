<?php

namespace Jimdo\JimKanWall\ViewBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jimdo\JimKanWall\ImportBundle\Entity\Board;

class BoardController extends Controller
{
    /**
     * @Route("/board/list", name="board_list")
     * @Template()
     * @return array
     */
    public function listAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $boards = $em->getRepository('Jimdo\JimKanWall\ImportBundle\Entity\Board')->findAll();

        return array('boards' => $boards);
    }

    /**
     * @Route("/board/detail/{boardId}", name="board_detail")
     * @Template()
     * @param $boardId
     * @return array
     */
    public function detailAction($boardId)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $boards = $em->getRepository('Jimdo\JimKanWall\ImportBundle\Entity\Board')->findAll();

        $entitiToViewMapper = $this->get('jimdo.entity_to_view_mapper');

        $snapShot = $entitiToViewMapper->getSnapShotDetail($boardId);

        return array('snapShot' => $snapShot, 'boards' => $boards);
    }

}