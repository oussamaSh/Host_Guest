<?php

namespace Home\AnnonceBundle\Controller;

use Home\AnnonceBundle\Form\MailAnnonceType;
use Home\EntityBundle\Entity\MailAnnonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swift_Message;
use Swift_Transport;

class MailAnnonceController extends Controller
{
    /*public function indexAction(Request $request)
    {
        $mail = new MailAnnonce();
        $form = $this->createForm(MailAnnonceType::class, $mail);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Reponse a votre message')
                ->setFrom('hostguesttn@gmail.com')
                ->setTo($mail->getEmailAdmin())
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($mail->getMessage());
            $this->get('mailer')->send($message);

        }
        return $this->render('HomeAnnonceBundle:Back_office:MailAnnonceAdmin.html.twig', array('form' => $form
            ->createView()));
    }*/


    public function successAction()
    {
        return new Response("email envoyé avec succès, Merci de vérifier votre adresse mail.");
    }


    public function AffichageListeMessagesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository("HomeEntityBundle:Contact")->findAll();

        $mail = new MailAnnonce();
        $form = $this->createForm(MailAnnonceType::class, $mail);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Reponse a votre message')
                ->setFrom('hostguesttn@gmail.com')
                ->setTo($mail->getEmailAdmin())
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($mail->getMessage());
            $this->get('mailer')->send($message);

        }

        return $this->render('HomeAnnonceBundle:Back_office:Liste_message_annonce.html.twig', array(
            "messages" => $messages,
            'form' => $form->createView()
        ));
    }


}