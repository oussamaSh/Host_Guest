<?php

namespace Home\ReclamationBundle\Repository;
use Doctrine\ORM\EntityRepository;

class ReclamationRepository extends EntityRepository
{
  public function cloturerreclamationAction($idReclamation)
  {
      $query=$this->getEntityManager()
          ->createQuery("Update  HomeEntityBundle:Reclamation r   set r.etat='Cloture' where r.idReclamation=:idReclamation")
          ->setParameter('idReclamation',$idReclamation);
      return $query->getResult();
  }

    public function recuperermaxidRepositoryAction()
    {
        $query=$this->getEntityManager()
            ->createQuery("select max(r.idReclamation) from HomeEntityBundle:Reclamation r");
        return $query->getSingleResult();
    }

    public function afficherreclamationfrontRepositoryAction($idMembre)
    {
        $query=$this->getEntityManager()
            ->createQuery("select r from HomeEntityBundle:Reclamation r  where r.idMembre=:idMembre")
            ->setParameter('idMembre',$idMembre);
        return $query->getResult();
    }

    public function rechercherReclamationBackRepository($etat,$type,$dateReclamation)
    {
        $query=$this->getEntityManager()
            ->createQuery("select r from HomeEntityBundle:Reclamation r where r.etat=:etat AND r.sujetReclamation=:sujetReclamation AND r.dateReclamation=:dateReclamation")
            ->setParameters(array('etat'=>$etat,'sujetReclamation'=>$type,'dateReclamation'=>$dateReclamation));
        return $query->getResult();
    }

    public function rechercherReclamationfrontRepository($etat,$type,$dateReclamation,$idMembre)
    {
        $query=$this->getEntityManager()
            ->createQuery("select r from HomeEntityBundle:Reclamation r where r.etat=:etat AND r.sujetReclamation=:sujetReclamation AND r.dateReclamation=:dateReclamation AND r.idMembre=:idMembre")
            ->setParameters(array('etat'=>$etat,'sujetReclamation'=>$type,'dateReclamation'=>$dateReclamation,'idMembre'=>$idMembre));
        return $query->getResult();
    }

    public function recherchereclamationback($etat,$sujet,$dateReclamation)
    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('R')
            ->from('HomeEntityBundle:Reclamation', 'R')
            ->andWhere('R.etat LIKE :etat AND R.sujetReclamation LIKE :sujet AND R.dateReclamation LIKE :dateReclamation')
            ->setParameter('etat', '%'.$etat.'%')
            ->setParameter('sujet', '%'.$sujet.'%')
            ->setParameter('dateReclamation', '%'.$dateReclamation.'%');

        $q = $qb->getQuery();
        return $q->execute();
    }

    public function recherchereclamationfront($etat,$sujet,$dateReclamation,$idMembre)
    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('R')
            ->from('HomeEntityBundle:Reclamation', 'R')
            ->where('R.etat LIKE :etat AND R.sujetReclamation LIKE :sujet AND R.dateReclamation LIKE :dateReclamation AND R.idMembre=:idMembre')
            ->setParameter('etat', '%'.$etat.'%')
            ->setParameter('sujet', '%'.$sujet.'%')
            ->setParameter('dateReclamation', '%'.$dateReclamation.'%')
            ->setParameter('idMembre',$idMembre);

        $q = $qb->getQuery();
        return $q->execute();
    }

    public function recupereridmembre($idReclamation)
    {
        $query=$this->getEntityManager()
            ->createQuery("select IDENTITY(r.idMembre) from HomeEntityBundle:Reclamation r  where r.idReclamation=:idReclamation")
            ->setParameter('idReclamation',$idReclamation);
        return $query->getSingleResult();
    }
    public function affichermsgfrontrecl($idReclamation,$idMembre)
    {
        $query=$this->getEntityManager()
            ->createQuery("select r from HomeEntityBundle:Reclamation r  where r.idReclamation=:idReclamation AND r.idMembre=:idMembre ")
            ->setParameter('idMembre',$idMembre)
            ->setParameter('idReclamation',$idReclamation);
        return $query->getResult();
    }
}