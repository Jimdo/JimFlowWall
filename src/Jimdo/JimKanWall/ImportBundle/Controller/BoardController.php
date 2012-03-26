<?php

namespace Jimdo\JimKanWall\ImportBundle\Controller;

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
     * @Route("/board/detail/{board_id}", name="board_detail")
     * @Template()
     * @param $board_id
     * @return array
     */
    public function detailAction($board_id)
    {
        $em = $this->get('doctrine')->getEntityManager();

        $snapShots = $em->getRepository('Jimdo\JimKanWall\ImportBundle\Entity\SnapShot')->getNewestSnapShotByBoard($board_id);

        $snapShot = $em->getRepository('Jimdo\JimKanWall\ImportBundle\Entity\SnapShot')->getPreBuildSnapShotById($snapShots[0]->getId());


        return array('snapShot' => $snapShot);
    }

}