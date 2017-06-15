<?php

/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 24/03/2017
 * Time: 11:09
 */

namespace Home\AvisBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Home\EntityBundle\Entity\Avishost;


class AvisHostRepository extends EntityRepository

{

    public function countTotalHost($idMembre)
    { $query=$this->getEntityManager()
        ->createQuery("select AVG (r.reactiviteHost) 
from HomeEntityBundle:Avishost  r where r.idMembre=$idMembre ");
        return $query->getSingleResult();
    }

    public function SignalerHost($id)
    {
        $qB = $this->getEntityManager()->createQueryBuilder();
        $qB ->update('HomeEntityBundle:Avishost', 'A')
            ->set('A.signalement ', '?1')
            ->where('A.idHost = ?2')
            ->setParameter(1, '1')
            ->setParameter(2, $id);
        $q = $qB->getQuery();
        return $q->execute();
    }

    public function findSignalementHost()
    { $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('u')
            ->from('HomeEntityBundle:Avishost', 'u')
            ->where('u.signalement = ?1')
            ->setParameter(1, '1');

        $q = $qb->getQuery();
        return $q->execute();

    }

    public function AfficherHost($id)
    { $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('u')
            ->from('HomeEntityBundle:Avishost', 'u')
            ->where('u.idHost= ?1')
            ->setParameter(1, $id);

        $q = $qb->getQuery();
        return $q->execute();

    }




    public function rechercheHostAction($word)

    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->from('HomeEntityBundle:Avishost', 'p')
            ->where('p.id LIKE :word')
            ->orWhere('p.type LIKE :word')
            ->setParameter('word', '%'.$word.'%');

        $q = $qb->getQuery();
        return $q->execute();

    }
    public function countAcceuilHost($idMembre)
    { $query=$this->getEntityManager()
        ->createQuery("select AVG (r.acceuilHost) 
from HomeEntityBundle:Avishost  r where r.idMembre=$idMembre ");
        return $query->getSingleResult();
    }
    public function countReactiviteHost($idMembre)
    { $query=$this->getEntityManager()
        ->createQuery("select AVG (r.reactiviteHost) 
from HomeEntityBundle:Avishost  r where r.idMembre=$idMembre ");
        return $query->getSingleResult();
    }

    public function countReviews($idMembre)
    { $query=$this->getEntityManager()
        ->createQuery("select COUNT (r.descriptionAvis ) 
from HomeEntityBundle:Avishost  r where r.idMembre='$idMembre' ");
        return $query->getSingleResult();
    }



}