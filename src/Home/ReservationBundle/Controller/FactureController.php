<?php

namespace Home\ReservationBundle\Controller;

use Home\EntityBundle\Entity\Facture;
use Home\ReservationBundle\Form\RechercheFacture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FactureController extends Controller
{
    public function AfficherListeFactureAction()
    {
        $em=$this->getDoctrine()->getManager();
        $factures=$em->getRepository("HomeEntityBundle:Facture")->findAll();

        return $this->render('HomeReservationBundle:Back_office:List_Factures.html.twig',array("factures"=>$factures));

    }
    function SupprimerFactureAction($idFacture){

        $em=$this->getDoctrine()->getManager();
        $facture=$em->getRepository("HomeEntityBundle:Facture")->find($idFacture);
        $em->remove($facture);
        $em->flush();
        return $this->redirectToRoute('Afficher_Factures');

    }
    function RechercheFactureAction(Request $request){
        $facture=new Facture();
        $em=$this->getDoctrine()->getManager();
        $factures=$em->getRepository("HomeEntityBundle:Facture")->findAll();
        $Form=$this->createForm(RechercheFacture::class,$facture);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $etat=$facture->getEtat();
            $factures=$em->getRepository("HomeEntityBundle:Facture")->rechercherFacture($etat);


        }
        return $this->render("HomeReservationBundle:Back_office:Recherche_Facture.html.twig", array("Form"=>$Form->createView(),'factures'=>$factures));

    }

}
