<?php

namespace Jimdo\JimFlow\ImportBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TicketToColumnRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketToColumnRepository extends EntityRepository
{
    public function getTicketInSnapShot($code, $snapShotId)
    {
        $qb = $this->createQueryBuilder('tc')
                   ->select('tc')
                   ->leftJoin('tc.snapShot', 's')
                   ->where('s.id = ?1')
                   ->andWhere('tc.id = ?2')
                   ->setMaxResults(1)
                   ->setParameter('1', $snapShotId)
                   ->setParameter('2', $code);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getLatestTicketToColumnByTicketId($ticket_id)
    {
        $qb = $this->createQueryBuilder('tc')
                   ->select('tc')
                   ->InnerJoin('tc.snapShot', 's', 'with', 'tc.snapShot = s.id')
                   ->where('tc.id = ?1')
                   ->addOrderBy('s.id', 'DESC')
                   ->setMaxResults(1)
                   ->setParameter('1', $ticket_id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getLatestSnapshotWithChangeByTicketId($ticket_id)
    {
        $qb = $this->createQueryBuilder('tc')
                   ->select('tc')
                   ->leftJoin('tc.snapShot', 's')
                   ->where('tc.id = ?1')
                   ->andWhere('tc.is_change = true')
                   ->addOrderBy('s.createdAt', 'DESC')
                   ->setMaxResults(1)
                   ->setParameter('1', $ticket_id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}