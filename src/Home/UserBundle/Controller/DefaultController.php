<?php

namespace Home\UserBundle\Controller;

use Home\NotificationBundle\HomeNotificationBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HomeUserBundle:Default:index.html.twig');
    }

    public function clientAction()
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->findAll();
        return $this->render('HomeAnnonceBundle:Pages_Annonce:Accueil_Annonces.html.twig',array('annonces'=>$annonce));
    }
    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->findAll();
        return $this->render('HomeAnnonceBundle:Back_office:Liste_Annonces.html.twig',array('annonces'=>$annonce));
    }

   /* public function getTokenAction()
    {
        return new Response($this->container->get('form.csrf_provider')
            ->generateCsrfToken('authenticate'));
    }*/
}
