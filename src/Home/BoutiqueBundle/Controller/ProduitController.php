<?php

namespace Home\BoutiqueBundle\Controller;

use Home\EntityBundle\Entity\Produit;
use Home\BoutiqueBundle\Form\ProduitType;
use Home\BoutiqueBundle\Form\RechercheProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Home\EntityBundle\Entity\DateAchat;

class ProduitController extends Controller
{

    public function AjoutProduitAction(Request $request)
    {
        $produits=new Produit();
        $form=$this->createForm( ProduitType::class,$produits);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($produits);
            $em->flush();
        }
        return $this->render("HomeBoutiqueBundle:Back_office:Ajout_produit.html.twig",array("form"=>$form->createView()));


    }

    public function AffichageListeProduitAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        //$produits=$em->getRepository("HomeEntityBundle:Produit")->findAll();
        $dql   = "SELECT p FROM HomeEntityBundle:Produit p";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3 /*limit per page*/
        );
        return $this->render('HomeBoutiqueBundle:Back_office:Liste_produit.html.twig',array("pagination"=>$pagination));

    }

    public function ModifierProduitAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository("HomeEntityBundle:Produit")->findOneBy(array("idProduit"=>$id));
        $form=$this->createForm( ProduitType::class,$produit);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            //MAIL :
            $message = \Swift_Message::newInstance()
                ->setSubject('ContactMail ')
                ->setFrom('eya.chakroun@esprit.tn')
                ->setTo('eya.chakroun@esprit.tn')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody('Merci pour votre fidélité votre Cadeau vous sera livré le');
            $this->get('mailer')->send($message);
            return $this->redirectToRoute("Liste_produit"); //tableau assocoatif
        }

        return $this->render("HomeBoutiqueBundle:Back_office:Ajout_produit.html.twig",array("form"=>$form->createView()));

    }



    public function SupprimerProduitAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("HomeEntityBundle:Produit")->findOneBy(array("idProduit"=>$id));
        /* $dateachat=$em->getRepository("HomeEntityBundle:DateAchat")->findOneBy(array("idProduit"=>$id));
         $liv=$em->getRepository("HomeEntityBundle:Livraison")->findOneBy(array("id_DateAchat"=>$dateachat->getIdDateAchat()));

             foreach ($dateachat as $dateachats)
             {
                 $em->remove($liv);//ynahhiha mel reposetery
                 $em->remove($dateachats);//ynahhiha mel reposetery

             }*/
        $em->remove($produits);//ynahhiha mel reposetery
        $em->flush();//ynahhiha mel base
        return $this->redirectToRoute("Liste_produit"); //tableau assocoatif

    }


    function RechercheProduitAction(Request $request){
        $produit=new Produit();
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("HomeEntityBundle:Produit")->findAll();
        $Form=$this->createForm(RechercheProduitType::class,$produit);
        $Form->handleRequest($request);
        $nomProduit=$produit->getNomProduit();
        if($Form->isValid()) {
            $produits = $em->getRepository("HomeEntityBundle:Produit")->RechercherProduit($nomProduit);
        }



        return $this->render("HomeBoutiqueBundle:Back_office:Rechercher_produit.html.twig", array("Form"=>$Form->createView(),'produits'=>$produits));

    }

    public function AffichageBoutiqueAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $produits=$em->getRepository("HomeEntityBundle:Produit")->AfficherQuantitepositive();

        return $this->render('HomeBoutiqueBundle:Front_office:Boutique.html.twig',array('produits' => $produits));

    }


    public function AffichageDetailsProduitAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $produit=$em->getRepository("HomeEntityBundle:Produit")->find($id);
        return $this->render('HomeBoutiqueBundle:Front_office:Details_produit.html.twig',array("produit"=>$produit));

    }


}
