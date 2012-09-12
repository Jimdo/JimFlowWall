<?php

namespace Jimdo\JimFlow\ImportBundle\TicketTrack;


class TicketTrack
{
    private $em;
    private $ticketProvider;
    
    public function __construct($em, $ticketProvider) {
        $this->em = $em;
        $this->ticketProvider = $ticketProvider;
    }
    
    public function run($snapShotId) {
        $ticketToColumns = $this->em->getRepository('Jimdo\JimFlow\ImportBundle\Entity\TicketToColumn')->getTicketToColumsBySnapShotAndChangeIsTrue($snapShotId);
        
        $snapShot = $this->em->find('Jimdo\JimFlow\ImportBundle\Entity\SnapShot', $snapShotId);
        
        if ($snapShot->getBoard()->getTrack() === true) 
        {
            foreach ($ticketToColumns as $ticketToColumn) {
                $status =  $ticketToColumn->getBoardColumn()->getStatus();
                $this->ticketProvider->setTicketStatusByCodeAndStatus($ticketToColumn->getId(), $status);
            }
        }  
    }

}
