<?php

namespace Home\LivraisonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HomeLivraisonBundle:Default:index.html.twig');
    }
}
