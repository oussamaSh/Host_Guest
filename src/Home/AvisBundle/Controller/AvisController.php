<?php

namespace Home\AvisBundle\Controller;
use Home\AvisBundle\Form\AvisType;
use Home\AvisBundle\Form\RechercheAvisLogement;
use Home\EntityBundle\Entity\Avis;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use  Home\AvisBundle\Repository\AvisRepository;
use  Home\AvisBundle\Repository\AvisHostRepository;

class AvisController extends Controller

{
    //Affichage Back

    public function ShowBackAction()
    {   $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avis")->findAll();
        return $this->render("HomeAvisBundle:Back:ShowAvis.html.twig",array("Avis"=>$Avis));
    }



//Supprimer Back
    public function supprimerAction($id)

    {
        $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avis")->findOneBy(array("idAvis"=>$id));
        $em->remove($Avis);
        $em->flush();

    }

    /*public function AfficherLogementAction()
    {
        $em=$this->getDoctrine()->getManager();
        $logementAvis=$em->getRepository("HomeEntityBundle:Logement")->find(7);

        return $this->render('HomeAvisBundle:Front:Details_Annonce.html.twig',array("logementAvis"=>$logementAvis));

    }*/



//AFFICHER TOUS LES SIGNALEMENT
    public function ShowSignalementAction()
    {   $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avis")->AfficherSignalement();
        $AvisHost=$em->getRepository("HomeEntityBundle:Avishost")->findSignalementHost();

        return $this->render("HomeAvisBundle:Back:AvisSignaler.html.twig",array("Avis"=>$Avis,"AvisHost"=>$AvisHost));
    }

    public function searchAvisLogementAction(Request $request)

    {   $Aviss=new Avis();
        $em = $this->getDoctrine()->getManager();
        $Avis = $em->getRepository("HomeEntityBundle:Avis")->findAll();
        $form = $this->createForm(RechercheAvisLogement::class, $Aviss);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $type = $Aviss->getIdAvis();
            $Avis= $em->getRepository("HomeEntityBundle:Avis")->rechercheLogement($type);
        }

        return $this->render("HomeAvisBundle:Back:RechercheAvisLogement.html.twig", array("form" => $form->createView(),
            'Avis'=>$Avis));
    }


}
