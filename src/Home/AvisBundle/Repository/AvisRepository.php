<?php

/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 24/03/2017
 * Time: 11:09
 */

namespace Home\AvisBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Home\EntityBundle\Entity\Avis;


class AvisRepository extends EntityRepository

{


    public function  SubscribeAction()

    {
        $em=$this->getDoctrine()->getManager();
        $Newsletter=$em->getRepository("HomeEntityBundle:Newsletter")->Subscribe();
        $em->flush();
        return $this->redirectToRoute('home_avis');

    }

    public function countAcceuil($idLogement)
    { $query=$this->getEntityManager()
        ->createQuery("select AVG (r.accueil) from HomeEntityBundle:Avis  r where r.idLogement=$idLogement ");
    return $query->getSingleResult();
    }
    public function countquaitePrix($idLogement)
    { $query=$this->getEntityManager()
        ->createQuery("select AVG (r.quaitePrix) 
from HomeEntityBundle:Avis  r where r.idLogement=$idLogement ");
        return $query->getSingleResult();
    }

    public function countnoteAvis($idLogement)
    { $query=$this->getEntityManager()
        ->createQuery("select AVG (r.noteAvis) 
from HomeEntityBundle:Avis  r where r.idLogement='$idLogement' ");
        return $query->getSingleResult();
    }

    public function countReviews($idLogement)
    { $query=$this->getEntityManager()
        ->createQuery("select COUNT (r.descriptionAvis ) 
from HomeEntityBundle:Avis  r where r.idLogement='$idLogement' ");
        return $query->getSingleResult();
    }



    public function countproprete($idLogement)
    { $query=$this->getEntityManager()
        ->createQuery("select AVG (r.proprete) 
from HomeEntityBundle:Avis  r where r.idLogement='$idLogement' ");
        return $query->getSingleResult();
    }

    public function countTotal($idLogement)
    { $query=$this->getEntityManager()
        ->createQuery("select AVG (r.proprete)
        from HomeEntityBundle:Avis  r where r.idLogement=$idLogement ");
        return $query->getSingleResult();
    }




    public function Signaler($id)
    {
        $qB = $this->getEntityManager()->createQueryBuilder();
        $qB ->update('HomeEntityBundle:Avis', 'A')
            ->set('A.signalement ', '?1')
            ->where('A.idAvis = ?2')
            ->setParameter(1, '1')
            ->setParameter(2, $id);
        $q = $qB->getQuery();
        return $q->execute();
    }

    public function AfficherSignalement()
    { $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('u')
            ->from('HomeEntityBundle:Avis', 'u')
            ->where('u.signalement = ?1')
            ->setParameter(1, '1');

        $q = $qb->getQuery();
        return $q->execute();

    }

    public function AfficherLogement($id_logement)
    { $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('u')
            ->from('HomeEntityBundle:Avis', 'u')
            ->where('u.idLogement= ?1')
            ->setParameter(1, $id_logement);

        $q = $qb->getQuery();
        return $q->execute();

    }



    public function rechercheLogement($word)

    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->from('HomeEntityBundle:Avis', 'p')
            ->where('p.idAvis LIKE :word')
            ->setParameter('word', '%'.$word.'%');

        $q = $qb->getQuery();
        return $q->execute();

    }











}