<?php
/**
 * Created by PhpStorm.
 * User: eya chakroun
 * Date: 06/04/2017
 * Time: 00:48
 */

namespace Home\BoutiqueBundle\Controller;


use Home\EntityBundle\Entity\DateAchat;
use Home\EntityBundle\HomeEntityBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DateAchatController extends Controller
{
    public function Ajout_Date_AchatAction(Request $request, $id)
    {

        $em= $this->getDoctrine()->getManager();
        $produits=$em->getRepository("HomeEntityBundle:Produit")->findAll();
        $DateAchat = new DateAchat();
        $membre = $em->getRepository("HomeUserBundle:User")->find($this->getUser());
        $date = new \DateTime();
        $Quantite = $request->get("quantite");
        $produit = $em->getRepository("HomeEntityBundle:Produit")->find($id);
        $prixTotal = $produit->getPrixProduit() * $Quantite;

        $QuantiteStock=$produit->getQuantiteProduit();
        $produit->setQuantiteProduit($QuantiteStock-$Quantite);
        if($produit->getQuantiteProduit()== 0)
        {
            $produit->setEtatProduit("Non disponible");
        }

        $pointsfidélite=$membre->getPointsFidelite();
        $membre->setPointsFidelite($pointsfidélite-$prixTotal);

        //if($membre->getPointsFidelite()>=$produit->getPrixProduit())

            if ($request->isMethod('POST')) {
                $DateAchat->setDateA($date);
                $DateAchat->setIdProduit($produit);
                $DateAchat->setIdMembre($membre);
                $DateAchat->setQuantiteProduit($request->get('quantite'));
                $DateAchat->setPrixTotal($prixTotal);
                $em->persist($DateAchat);
                $em->flush();
                return $this->redirectToRoute('Ajouter_Livraison');
            }


            return $this->render("@HomeBoutique/Front_office/Boutique.html.twig", array("produits"=>$produits));

        //return $this->redirectToRoute("Ajouter_Livraison");

    }

    public function AffichageAchatAction()
    {
        $em= $this->getDoctrine()->getManager();
        $Achats=$em->getRepository("HomeEntityBundle:DateAchat")->findAll();
        $livraison="";
        //$livraison=$em->getRepository("HomeEntityBundle:Livraison")->findBy(array('idProduit'=>$idProduit));

        return $this->render('HomeBoutiqueBundle:Back_office:AffichageLivraison.html.twig',array("Achats"=>$Achats,"livraison"=>$livraison));

    }






}