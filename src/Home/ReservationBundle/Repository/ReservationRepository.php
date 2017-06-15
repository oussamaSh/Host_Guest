<?php

namespace Home\ReservationBundle\Repository;
use Doctrine\ORM\EntityRepository;
class ReservationRepository extends EntityRepository
{

    public function rechercherReservation($etat){

        $query=$this->getEntityManager()->createQuery(" SELECT r from HomeEntityBundle:Reservation r WHERE r.etat=:etat")
            ->setParameter('etat',$etat);
        return $query->getResult();
    }

    public function rechercherFacture($etat){

        $query=$this->getEntityManager()->createQuery(" SELECT f from HomeEntityBundle:Facture f WHERE f.etat=:etat")
            ->setParameter('etat',$etat);
        return $query->getResult();
    }


}
