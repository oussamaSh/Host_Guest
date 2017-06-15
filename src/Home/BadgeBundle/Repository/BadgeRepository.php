<?php


namespace Home\BadgeBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Home\EntityBundle\Entity\Modelbadge;

class BadgeRepository extends EntityRepository
{/*

    public function rechercheBadge($type)

    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->from('HomeEntityBundle:Modelbadge', 'p')
            ->where('p.titre LIKE :word')
            //->orWhere('p.type LIKE :word')
            ->setParameter('word', '%'.$type.'%');

        $q = $qb->getQuery();
        return $q->execute();

    }

*/




}