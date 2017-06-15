<?php

namespace Home\AnnonceBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Home\EntityBundle\Entity\Image;

class LogementRepository extends EntityRepository
{
    public function getAll()
    {
        $query = $this->getEntityManager()
            ->createQuery("
            SELECT log FROM HomeEntityBundle:Logement log JOIN HomeEntityBundle:Image img WHERE log.idLogement=img.idLogement
            ");


        return $query->getResult();


    }

    public function findImage()
    {
        $query = $this->getEntityManager()
            ->createQuery("
            SELECT log.idImage FROM HomeEntityBundle:Image log WHERE log.idLogement=5
            ");
           // ->setParameter('idLogement',$idLogement);

        return $query->getResult();

    }

    public function maxId(){
        $em = $this->getEntityManager();
        $highest_id = $em->createQueryBuilder()
            ->select('MAX(e.idLogement)')
            ->from('HomeEntityBundle:Logement', 'e')
            ->getQuery()
            ->getSingleScalarResult();
        return $highest_id;
    }
    public function ajoutAssociation($idEquipement){
        $rsm = new ResultSetMapping();
        $query = $this->_em->createNativeQuery('INSERT INTO annonce_association SET Id_equipement = ?', $rsm);
        //$query->setParameter(1, $idLogement);
        $query->setParameter(1, $idEquipement);

       return $result = $query->getResult();
    }
    public function rechercheAnnonce($word,$region,$nbrChambre,$typeLogement/*,$prixMin,$prixMax*/)

    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('L')
            ->from('HomeEntityBundle:Logement', 'L')
          //  ->where('L.titreAnnonce LIKE :word')
            ->andWhere('L.titreAnnonce LIKE :word AND L.region LIKE :region
             AND L.nbrChambre LIKE :nbrChambre AND L.typeLogement LIKE :typeLogement ')

         //   ->orWhere(' L.prixLogement BETWEEN :prixMin AND :prixMax')
           //->orWhere('L.prixLogement > :prixMin AND L.prixLogement < :prixMax')
            //->orWhere('L.titreAnnonce LIKE :word AND L.region is null')
            //  ->orWhere('L.titreAnnonce is null AND L.region LIKE :region')
            ->setParameter('word', '%'.$word.'%')
            ->setParameter('region', '%'.$region.'%')
            ->setParameter('nbrChambre', '%'.$nbrChambre.'%')
        ->setParameter('typeLogement', '%'.$typeLogement.'%');

      /*  ->setParameter('prixMin', '%'.$prixMin.'%')
        ->setParameter('prixMax', '%'.$prixMax.'%');
AND  ( L.prixLogement BETWEEN :prixMin AND :prixMax ) */


        // ->setParameters(array('word' => '%'.$word.'%', 'region' => '%'.$region.'%'));
        $q = $qb->getQuery();
        return $q->execute();

    }

    public function rechercheAnnonceBack($word,$region)

    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('L')
            ->from('HomeEntityBundle:Logement', 'L')
            ->andWhere('L.titreAnnonce LIKE :word AND L.region LIKE :region')
            ->setParameter('word', '%'.$word.'%')
            ->setParameter('region', '%'.$region.'%');

        $q = $qb->getQuery();
        return $q->execute();

    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM HomeEntityBundle:Logement e
                WHERE e.titreAnnonce LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }


}