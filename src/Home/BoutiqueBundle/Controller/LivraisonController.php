<?php
/**
 * Created by PhpStorm.
 * User: eya chakroun
 * Date: 06/04/2017
 * Time: 16:46
 */

namespace Home\BoutiqueBundle\Controller;


use Home\EntityBundle\DependencyInjection\Configuration;
use Home\EntityBundle\Entity\DateAchat;
use Home\EntityBundle\Entity\Livraison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class LivraisonController extends Controller
{

    public function Ajout_LivraisonAction(Request $request)
    {
       // $panier=new DateAchat();
        $em= $this->getDoctrine()->getManager();
        $livraison=new Livraison();
        $panier=$em->getRepository("HomeEntityBundle:DateAchat")->recuperermaxidRepositoryAction();
        //$dateAchat = $em->getRepository("HomeEntityBundle:DateAchat")->findOneBy(array('idDateAchat'=>$id));
        $datepanier=$em->getRepository("HomeEntityBundle:DateAchat")->find($panier);
        $date =$request->get("date");
        $date_livraison= new \DateTime($date);
        $etat="non livré";


        if ( $request->isMethod('POST') )
        {
            $livraison->setIdDateAchat($datepanier);
            $livraison->setAdresseDestination($request->get('adresse'));
            $livraison->setCodePostal($request->get("code_postal"));
            $livraison->setDateLivraison($date_livraison);
            $livraison->setRegion($request->get("region"));
            $livraison->setEtatLivraison($etat);
            $em->persist($livraison);
            $em->flush();

            //MAIL :
            $message = \Swift_Message::newInstance()
                ->setSubject('ContactMail ')
                ->setFrom('eya.chakroun@esprit.tn')
                ->setTo('eya.chakroun@esprit.tn')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody('Merci pour votre fidélité votre Cadeau vous sera livré');
            $this->get('mailer')->send($message);
            return $this->redirectToRoute('Boutique');
        }



        return $this->render("@HomeBoutique/Front_office/Livraison.html.twig",array());

    }



    public function updateEtatAction($idProduit){
        $em= $this->getDoctrine()->getManager();
        $livraison = $em->getRepository("HomeEntityBundle:Livraison")->findAll();



    }

    public function AffichageListeLivraisonAction($idDateAchat,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $Achats=$em->getRepository("HomeEntityBundle:DateAchat")->findAll();
        $livraison=$em->getRepository("HomeEntityBundle:Livraison")->findBy(array('id_DateAchat'=> $idDateAchat));
        //$livraison_liv=$em->getRepository("HomeEntityBundle:Livraison")->find($idDateAchat);
        $alliv=$em->getRepository("HomeEntityBundle:Livraison")->findAll();
        //$alliv=$em->getRepository("HomeEntityBundle:Livraison")->UpdateEtatLivraison();

        foreach($alliv as $allivs)
        {
            $date=new \DateTime();
            $date1= $allivs->getDateLivraison();
            $difference= $date ->diff($date1) ;
            if($difference->format('%d')<=0)
            {
                $allivs->setEtatLivraison('Livrée');
                $em->persist($allivs);
                $em->flush();
            }

        }



        return $this->render('HomeBoutiqueBundle:Back_office:AffichageLivraison.html.twig',array("livraison"=>$livraison,'Achats'=>$Achats));

    }

/*
    public function AffichageListeLivraisonAction($iddateAchat)
    {
        $em= $this->getDoctrine()->getManager();
        $Achats=$em->getRepository("HomeEntityBundle:DateAchat")->findAll();
        $livraison=$em->getRepository("HomeEntityBundle:Livraison")->findBy($iddateAchat);

        $datesys=new \DateTime();
        if ($livraison==$datesys)
        {
            $liv=$em->getRepository("HomeEntityBundle:Livraison")->UpdateEtatLivraison();
            $em->persist($livraison);
            $em->flush();
        }

        return $this->render('HomeBoutiqueBundle:Back_office:AffichageLivraison.html.twig',array("livraison"=>$livraison,'Achats'=>$Achats));

    }
*/



}