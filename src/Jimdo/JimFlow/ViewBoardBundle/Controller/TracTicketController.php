<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jimdo\JimFlow\ImportBundle\Entity\Board;

class TracTicketController extends Controller
{
    /**
     * @Route("/ticket/{ticketId}/boards", name="ticket_trac_on_board")
     * @Template()
     * @param $ticketId
     * @return array
     */
    public function ticketOnBoardAction($ticketId)
    {
        $code = 'T' . $ticketId;

        $em = $this->get('doctrine.orm.entity_manager');

        $boards = $em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\Board')->findAll();

        $snapShotRepository = $em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\SnapShot');
        $ticketToColumnRepository = $em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\TicketToColumn');

        $tickets = array();

        foreach ($boards as $board)
        {
            $snapShot = $snapShotRepository->getNewestSnapShotByBoardId($board->getId());

            $ticket = $ticketToColumnRepository->getTicketInSnapShot($code, $snapShot->getId());

            if ($ticket)
            {
                $tickets[$board->getName()] = $ticket->getBoardColumn()->getName();
            }
        }
        return array('tickets' => $tickets);
    }
}