<?php

namespace Home\FavorisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HomeFavorisBundle:Default:index.html.twig');
    }
}
