<?php

namespace Home\ReclamationBundle\Controller;

use Home\EntityBundle\Entity\Message;
use Home\EntityBundle\Entity\Notification;
use Home\EntityBundle\Entity\Reclamation;
use Home\UserBundle\Entity\User;
use Home\ReclamationBundle\Form\ReclamationType;
use Home\ReclamationBundle\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\Date;
use Home\ReclamationBundle\Form\Recherchereclamationform;
use Ob\HighchartsBundle\Highcharts\Highchart;

class ReclamationController extends Controller
{
    public function AfficherreclamationbackAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->findAll();
        $message="";
        return $this->render('HomeReclamationBundle:Back_office:Afficher_reclamation_back.html.twig',array("reclamations"=>$reclamation));
    }

    public function AfficherRechreclamationbackAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->findAll();
        $message="";
        return $this->render('HomeReclamationBundle:Back_office:Afficher_reclamation_back.html.twig',array("reclamations"=>$reclamation));
    }

    public function AffichermessageAction($idReclamation)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->findBy(array("idReclamation"=>$idReclamation));
        $message=$em->getRepository("HomeEntityBundle:Message")->findBy(array("idReclamation"=>$idReclamation));
        return $this->render('HomeReclamationBundle:Back_office:Afficher_msg_reclamation_back.html.twig',array("reclamations"=>$reclamation,"messages"=>$message));
    }

    public function Cloturerreclamation2Action($idReclamation)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->cloturerreclamationAction($idReclamation);
        return  $this->redirectToRoute("Afficherreclamationback_route");
    }

    public function CloturerreclamationfrontAction($idReclamation)
    {
        $em=$this->getDoctrine()->getManager();
        $em->getRepository("HomeEntityBundle:Reclamation")->cloturerreclamationAction($idReclamation);
        return  $this->redirectToRoute("Afficherreclamationfront_route");
    }

    public function AjouterReclamationAction(Request $request)
    {
        $reclamation=new Reclamation();
        $message=new Message();
        $em=$this->getDoctrine()->getManager();
        $reclamations=$em->getRepository("HomeEntityBundle:Reclamation")->recuperermaxidRepositoryAction();
        $membre=$em->getRepository("HomeUserBundle:User")->find($this->getUser());
        $date=new \DateTime();
        $etat="En cours";
        $contenu_admin="";

        if ($request->isMethod('POST')){

            $reclamation->setDateReclamation($date);
            $reclamation->setSujetReclamation($request->get('type_reclamation'));
            $reclamation->setEtat($etat);
            $reclamation->setIdMembre($membre);
            $message->setContenuAdmin($contenu_admin);
            $message->setContenuMembre($request->get('contenu_membre'));
            $message->setTimeMsg($date);
            $message->setIdReclamation($reclamation);
            $em->persist($reclamation);
            $em->persist($message);
            $em->flush();
        }
        return $this->render("HomeReclamationBundle:Front_office:Passer_reclamation.html.twig",array());
    }

    public function repondrereclamationadminAction(Request $request,$idReclamation)
    {
        $message=new Message();
        $em=$this->getDoctrine()->getManager();
        $date=new \DateTime();
        $contenu_membre="";
        $membre=$em->getRepository("HomeEntityBundle:Reclamation")->find($idReclamation);
        $test=$em->getRepository("HomeEntityBundle:Reclamation")->find($idReclamation);
        $Model_notif = $em->getRepository("HomeEntityBundle:ModelNotif")->recuperermodelnotifAction("Reclamation");
        $lu=0;
        $idmembre=$em->getRepository("HomeUserBundle:User")->find(1);
        $notification = new Notification();

        if ($request->isMethod('POST')) {
            $message->setContenuAdmin($request->get('contenu_admin'));
            $message->setContenuMembre($contenu_membre);
            $message->setTimeMsg($date);
            $message->setIdReclamation($membre);

            $notification->setDateNotification($date);
            $notification->setContenuNotification($Model_notif['contenuNotif']);
            $notification->setTypeNotification("Reclamation");
            $notification->setLu($lu);
            $notification->setIdMembre($test->getIdMembre());

            $em->persist($notification);
            $em->persist($message);
            $em->flush();

            $mail = \Swift_Message::newInstance()
                ->setSubject("Réponse réclamation")
                ->setFrom('med.sahbani@esprit.tn')
                ->setTo('med.sahbani@esprit.tn')
                ->setBody("vous avez un nouveau message")
                ->setCharset('utf-8')
                ->setContentType('text/html');
            $this->get('mailer')->send($mail);

        }

        return  $this->redirectToRoute("Afficherreclamationback_route");
    }

    public function repondrereclamationmembreAction(Request $request,$idReclamation)
    {
        $message=new Message();
        $em=$this->getDoctrine()->getManager();
        $date=new \DateTime();
        $contenu_admin="";
        $id=$em->getRepository("HomeEntityBundle:Reclamation")->find($idReclamation);
        if ($request->isMethod('POST')) {
            $message->setContenuAdmin($contenu_admin);
            $message->setContenuMembre($request->get('contenu_membre'));
            $message->setTimeMsg($date);
            $message->setIdReclamation($id);
            $em->persist($message);
            $em->flush();
        }

        return  $this->redirectToRoute("Afficherreclamationfront_route");
    }

    public function supprimerReclamationAction($idReclamation)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->findOneBy(array("idReclamation"=>$idReclamation));
        $message=$em->getRepository("HomeEntityBundle:Message")->findBy(array("idReclamation"=>$idReclamation));
        foreach ($message as $messages)
        {
            $em->remove($messages);
        }
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute("Afficherreclamationback_route");
    }

    public function supprimerReclamationFrontAction($idReclamation)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->findOneBy(array("idReclamation"=>$idReclamation));
        $message=$em->getRepository("HomeEntityBundle:Message")->findBy(array("idReclamation"=>$idReclamation));
        foreach ($message as $messages)
        {
            $em->remove($messages);
        }
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute("Afficherreclamationfront_route");
    }

    public function AfficherreclamationfrontAction()
    {
        $user=new User();
        $em=$this->getDoctrine()->getManager();
        //$reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->affichermsgfrontrecl($idReclamation,$this->getUser());
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->afficherreclamationfrontRepositoryAction($this->getUser());
        $message="";
        return $this->render('HomeReclamationBundle:Front_office:Afficher_reclamation_front.html.twig',array("reclamations"=>$reclamation,"messages"=>$message));
    }

    public function AffichermessagefrontAction($idReclamation)
    {
        $user=new User();
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->affichermsgfrontrecl($idReclamation,$this->getUser());
        $message=$em->getRepository("HomeEntityBundle:Message")->findBy(array("idReclamation"=>$idReclamation));
        return $this->render('HomeReclamationBundle:Front_office:Afficher_msg_reclamation_front.html.twig',array("reclamations"=>$reclamation,"messages"=>$message));
    }

    public function RechercherReclamationAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->findAll();
        $message="";
        return $this->render('HomeReclamationBundle:Back_office:Recherche_reclamation_back.html.twig',array("reclamations"=>$reclamation));
    }

    public function RechercherReclamationfrontAction(Request $request)
    {
        $user=new User();
        $em=$this->getDoctrine()->getManager();
        //$reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->affichermsgfrontrecl($idReclamation,$this->getUser());
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->afficherreclamationfrontRepositoryAction($this->getUser());
        $message="";
        return $this->render('HomeReclamationBundle:Front_office:Recherche_reclamation_front.html.twig',array("reclamations"=>$reclamation,"messages"=>$message));
    }

    public function RechercheReclamationBackAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $searchParameter =  $request->get('key');
        $searchParameter2 =  $request->get('key2');
        $searchParameter3 =  $request->get('key3');

        $reclamation= $em->getRepository('HomeEntityBundle:Reclamation')->recherchereclamationback($searchParameter,$searchParameter2,$searchParameter3);

        return $this->render('HomeReclamationBundle:Back_office:AjaxRecherche_reclamation_back.html.twig', array(
            'reclamations' => $reclamation));

    }

    public function RechercherReclamationfrontAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $searchParameter =  $request->get('key');
        $searchParameter2 =  $request->get('key2');
        $searchParameter3 =  $request->get('key3');

        $reclamation= $em->getRepository('HomeEntityBundle:Reclamation')->recherchereclamationfront($searchParameter,$searchParameter2,$searchParameter3,$this->getUser());

        return $this->render('HomeReclamationBundle:Front_office:AjaxRecherche_reclamation_front.html.twig', array(
            'reclamations' => $reclamation));

    }

    public function chartAction()
    {
        $em=$this->getDoctrine()->getManager();
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Statistique sur les etats des réclamations');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $reclamation=$em->getRepository("HomeEntityBundle:Reclamation")->findAll();
        $Stock=0;
        $cloture=0;
        $noncloture=0;
        foreach ($reclamation as $reclamations)
        {
            if(($reclamations->getEtat())=="Cloture")
            {
                $cloture=$cloture+1;
            }
            elseif(($reclamations->getEtat())=="En cours")
            {
                $noncloture=$noncloture+1;
            }
            $Stock=$Stock+1;
        }
        $b=($noncloture*100)/$Stock;
        $a=($cloture*100)/$Stock;
        $data = array(
            array('En cours',$b),
            array('Cloture', $a),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('HomeReclamationBundle:Back_office:stat.html.twig', array(
            'chart' => $ob));
    }

}
