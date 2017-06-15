<?php

namespace Home\BadgeBundle\Controller;
use Home\BadgeBundle\Form\ModelbadgeType;
use Home\BadgeBundle\Form\RechercheModelbadgeType;
use Home\EntityBundle\Entity\Modelbadge;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use  Home\EntityBundle\Entity\BadgeRepository;


class BadgeController extends Controller
{


    public function photoAction()
    {
        $badges = $this->getDoctrine()->getManager()
            ->getRepository('HomeEntityBundle:Modelbadge')->findAll();
        return $this->render('HomeBadgeBundle:Back:afficherBadge.html.twig', array('badges' => $badges));
    }

    public function showFrontBadgeAction()
    {
        $badges = $this->getDoctrine()->getManager()
            ->getRepository('HomeEntityBundle:Modelbadge')->findAll();
        return $this->render('HomeBadgeBundle:Front:enjareb.html.twig', array('badges' => $badges));
    }



    public function modifierAction(Request $request,$id)

    {
        $em = $this->getDoctrine()->getManager();

        $badge = $em->getRepository("HomeEntityBundle:Modelbadge")->findOneBy(array("idModelbadge" => $id));
        $form = $this->createForm(ModelbadgeType::class, $badge);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($badge);
            $em->flush();
            return $this->redirectToRoute("AfficherBadge_route");
        }

        return $this->render("HomeBadgeBundle:Back:addBadge.html.twig", array("form" => $form->createView()));
    }

    public function ajouterAction(Request $request)
    {


        $badge=new Modelbadge();
        $form=$this->createForm(ModelbadgeType::class,$badge);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($badge);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('ContactMail ')
                ->setFrom('eya.chakroun@esprit.tn')
                ->setTo('eya.chakroun@esprit.tn')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody('ContactMail ');
            $this->get('mailer')->send($message);

        }
        return $this->render("HomeBadgeBundle:Back:addBadge.html.twig",array("form"=>$form->createView()));


    }

    public function searchAction(Request $request)

    {   $badge=new Modelbadge();
        $em = $this->getDoctrine()->getManager();
        $badges = $em->getRepository("HomeEntityBundle:Modelbadge")->findAll();
        $form = $this->createForm(RechercheModelbadgeType::class, $badge);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $type = $badge->getType();
            $badges= $em->getRepository("HomeEntityBundle:Modelbadge")->rechercheBadge($type);
        }

        return $this->render("HomeBadgeBundle:Back:recherche.html.twig", array("form" => $form->createView(),
            'badges'=>$badges));
    }

    public function supprimerAction($id)

    {
        $em=$this->getDoctrine()->getManager();
        $badge=$em->getRepository("HomeEntityBundle:Modelbadge")->findOneBy(array("idModelbadge"=>$id));
        $em->remove($badge);
        $em->flush();
        return $this->redirectToRoute("AfficherBadge_route");

    }

}
