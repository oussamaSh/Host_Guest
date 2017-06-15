<?php

namespace Home\NotificationBundle\Controller;

use Home\EntityBundle\Entity\ModelNotif;
use Home\EntityBundle\Entity\Notification;
use Home\NotificationBundle\Form\ModelNotifType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Home\NotificationBundle\Form\rechercheModelNotifForm;

class NotificationController extends Controller
{

    public function AfficherModelNotificationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modelnotif = $em->getRepository("HomeEntityBundle:ModelNotif")->findAll();
        return $this->render('HomeNotificationBundle:Back_office:Afficher_model_notification.html.twig', array("modelnotifs" => $modelnotif));
    }

    public function AfficherModelNotificationRechAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modelnotif = $em->getRepository("HomeEntityBundle:ModelNotif")->findAll();
        return $this->render('HomeNotificationBundle:Back_office:Rechercher_model_notif.html.twig', array("modelnotifs" => $modelnotif));
    }

    public function rechercheModelNotificationAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $searchParameter = $request->get('q');
        $entities = $em->getRepository('HomeEntityBundle:ModelNotif')->RechercherModelNotifRepositoryAction($searchParameter);
        return $this->render('HomeNotificationBundle:Back_office:RechercheAjax.html.twig', array(
            'modelnotifs' => $entities,
        ));
    }

    public function SupprimerModelNotificationAction($idModelNotif)
    {
        $em = $this->getDoctrine()->getManager();
        $modelnotif = $em->getRepository("HomeEntityBundle:ModelNotif")->findOneBy(array("idModelNotif" => $idModelNotif));
        $em->remove($modelnotif);
        $em->flush();
        return $this->redirectToRoute("Affichermodelnotification_route");
    }

    public function AjouterModelNotifAction(Request $request)
    {
        $modelnotif = new ModelNotif();
        $form = $this->createForm(ModelNotifType::class, $modelnotif);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modelnotif);
            $em->flush();
            return $this->redirectToRoute("Affichermodelnotification_route");
        }
        return $this->render("HomeNotificationBundle:Back_office:Ajouter_model_notif.html.twig", array("form" => $form->createView()));
    }

    public function recuperermodelnotif2Action($typeNotif)
    {
        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository("HomeEntityBundle:ModelNotif")->recuperermodelnotifAction($typeNotif);
        return $this->render('HomeNotificationBundle:Back_office:Afficher_model_notification.html.twig', array("notifications" => $notification));
    }

    public function AfficherNotificationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository("HomeEntityBundle:Notification")->affichernotification($this->getUser());
        return $this->render('HomeNotificationBundle:Front_office:Afficher_notification.html.twig', array("notifications" => $notification));
    }

    public function SupprimerNotificationAction($idNotification)
    {
        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository("HomeEntityBundle:Notification")->findOneBy(array("idNotification" => $idNotification));
        $em->remove($notification);
        $em->flush();
        return $this->redirectToRoute("Affichernotification_route");
    }

    public function LireNotificationAction($idNotification)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("HomeEntityBundle:Notification")->LireNotificationRepositoryAction($idNotification);
        $notification = $em->getRepository("HomeEntityBundle:Notification")->findBy(array("idNotification" => $idNotification));
        return $this->render("HomeNotificationBundle:Front_office:Lirenotification.html.twig", array("notifications" => $notification));
    }

    public function RechercherModelNotifAction(Request $request)
    {
        $notification = new ModelNotif();
        $em = $this->getDoctrine()->getManager();
        $notifications = $em->getRepository("HomeEntityBundle:ModelNotif")->findAll();
        $Form = $this->createForm(rechercheModelNotifForm::class, $notification);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $typeNotif = $notification->getTypeNotif();
            $notifications = $em->getRepository("HomeEntityBundle:ModelNotif")
                ->RechercherModelNotifRepositoryAction($typeNotif);
        }
        return $this->render('HomeNotificationBundle:Back_office:Rechercher_model_notif.html.twig',
            array("Form" => $Form->createView(), "notifications" => $notifications));
    }

    public function ModifierModelNotifAction(Request $request, $idModelNotif)
    {
        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository("HomeEntityBundle:ModelNotif")->find($idModelNotif);
        $Form = $this->createForm(ModelNotifType::class, $notification);
        $Form->handleRequest($request);

        if ($Form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();
            return $this->redirectToRoute('Affichermodelnotification_route');
        }
        return $this->render('HomeNotificationBundle:Back_office:Modifier_model_notif.html.twig', array('form' => $Form->createView()));
    }
}