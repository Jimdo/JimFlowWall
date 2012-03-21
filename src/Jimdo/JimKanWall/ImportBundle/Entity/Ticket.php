<?php

namespace Jimdo\JimKanWall\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jimdo\JimKanWall\ImportBundle\Entity\Ticket
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jimdo\JimKanWall\ImportBundle\Entity\TicketRepository")
 */
class Ticket
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}