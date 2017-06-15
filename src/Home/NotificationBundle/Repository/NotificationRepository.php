<?php
namespace Home\NotificationBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * Created by PhpStorm.
 * User: Sahbani
 * Date: 22/03/2017
 * Time: 15:01
 */
class NotificationRepository extends EntityRepository
{
    public function recuperermodelnotifAction($typeNotif)
    {
        $query=$this->getEntityManager()
            ->createQuery("select n.contenuNotif from HomeEntityBundle:ModelNotif n  where n.typeNotif=:typeNotif")
            ->setParameter('typeNotif',$typeNotif);
        return $query->getSingleResult();
    }
    public function EnvoyerNotificationRepositoryAction($idMembre)
    {
        $query=$this->getEntityManager()
            ->createQuery("insert into HomeEntityBundle:Notification n.typeNotification,n.contenuNotification,n.lu,n.idMembre,n.dateNotification")
            ->setParameter(array('typeNotification'=>'Badge','contenuNotification'=>'bla','lu'=>0,'idMmebre'=>$idMembre,'dateNotification'=>'2017-04-05'));
        return $query->getResult();
    }
    public function LireNotificationRepositoryAction($idNotification)
    {
        $query=$this->getEntityManager()
            ->createQuery("Update  HomeEntityBundle:Notification n set n.lu=1 where n.idNotification=:idNotification")
            ->setParameter('idNotification',$idNotification);
        return $query->getResult();
    }
    public function RechercherModelNotifRepositoryAction($typeNotif)
    {
        $query=$this->getEntityManager()
            ->createQuery("select n from HomeEntityBundle:ModelNotif n where n.typeNotif=:typeNotif")
            ->setParameter('typeNotif',$typeNotif);
        return $query->getResult();
    }

    public function recherchemodelnotif($word)
    {
        $qb= $this->getEntityManager()->createQueryBuilder();
        $qb->select('L')
            ->from('HomeEntityBundle:ModelNotif', 'L')
            ->where('L.typeNotif LIKE :word')
            ->setParameter('word', '%'.$word.'%');

        $q = $qb->getQuery();
        return $q->execute();

    }
    public function affichernotification($id)
    {
        $query=$this->getEntityManager()
            ->createQuery("select n from HomeEntityBundle:Notification n where n.idMembre=:idMembre")
            ->setParameter('idMembre',$id);
        return $query->getResult();
    }
}