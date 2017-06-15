<?php

namespace Home\BoutiqueBundle\Repository;
use Doctrine\ORM\EntityRepository;
class ProduitRepository extends EntityRepository
{

    public function RechercherProduit($nomProduit){

        $query=$this->getEntityManager()->createQuery(" SELECT r from HomeEntityBundle:Produit r WHERE r.nomProduit=:nomProduit ")
            ->setParameter('nomProduit',$nomProduit);
        return $query->getResult();
    }

    public function AfficherQuantitepositive()
    {
        $query=$this->getEntityManager()
            ->createQuery('select r from HomeEntityBundle:Produit r WHERE r.quantiteProduit > :num')
        ->setParameter('num', '0');
        return $query->getResult();

    }

    /*public function iProduit($idProduit){
        $query=$this->getEntityManager()->createQuery(" SELECT r.prixProduit from HomeEntityBundle:Produit r WHERE r.idProduit=:idProduit ")
            ->setParameter('idProduit',$idProduit);
        return $query->getResult();
    }*/
    public function UpdateEtatLivraison()
    {
        $datesystem=new \DateTime();
       // $datesystem=$datesystem->format('d/m/Y');

        $qB = $this->getEntityManager()->createQueryBuilder();
        $qB ->update('HomeEntityBundle:Livraison', 'L')
            ->set('L.Etat_livraison ','?1')
            ->where('L.dateLivraison = ?2')
            ->setParameter(1, 'Livrée')
            ->setParameter(2, $datesystem);
        $q = $qB->getQuery();
        return $q->execute();
    }

    /*public function recuperermaxidRepositoryAction()
    {
        $query=$this->getEntityManager()
            ->createQuery("select max(r.idDateAchat) from HomeEntityBundle:DateAchat r");
        return $query->getSingleResult();



    }
*/

    public function recuperermaxidRepositoryAction(){
        $em = $this->getEntityManager();
        $highest_id = $em->createQueryBuilder()
            ->select('MAX(e.idDateAchat)')
            ->from('HomeEntityBundle:DateAchat', 'e')
            ->getQuery()
            ->getSingleScalarResult();
        return $highest_id;
    }


}