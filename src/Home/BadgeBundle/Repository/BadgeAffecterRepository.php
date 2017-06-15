<?php


namespace Home\BadgeBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Home\EntityBundle\Entity\Modelbadge;
use Home\EntityBundle\Entity\Badge;

class BadgeAffecterRepository extends EntityRepository
{/*
    public function recupererModelBadge()
    { $qb= $this->getEntityManager()->createQueryBuilder('u');
        $qb->select('u.titre, u.descriptionBadge ,u.path')
            ->from('HomeEntityBundle:Modelbadge ', 'u')
            ->where('u.type = ?1')
            ->setParameter(1, 'reservation');

        $q = $qb->getQuery();
        return $q->execute();

    }

*/
    public function recuperermodelnotifAction($typeNotif)
    {
        $query=$this->getEntityManager()
            ->createQuery("select n.titre,n.descriptionBadge,n.path from HomeEntityBundle:Modelbadge n  where n.type=:type")
            ->setParameter('type',$typeNotif);
        return $query->getSingleResult();
    }



    public function rechercheBadge($type)

    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->from('HomeEntityBundle:Modelbadge', 'p')
            ->where('p.titre LIKE :word')
            ->orWhere('p.type LIKE :word')
            ->setParameter('word', '%'.$type.'%');

        $q = $qb->getQuery();
        return $q->execute();

    }

    public function Subscribe($id)
    {
        $qB = $this->getEntityManager()->createQueryBuilder();
        $qB ->update('HomeUserBundle:User ', 'A')
            ->set('A.newsletter ', '?1')
            ->where('A.id = ?2')
            ->setParameter(1, '1')
            ->setParameter(2, $id);
        $q = $qB->getQuery();
        return $q->execute();
    }


}