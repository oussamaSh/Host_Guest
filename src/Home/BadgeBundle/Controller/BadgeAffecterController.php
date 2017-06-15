<?php

namespace Home\BadgeBundle\Controller;

use Home\EntityBundle\Entity\Badge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BadgeAffecterController extends Controller
{

    public function MonBadgeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Badges=$em->getRepository("HomeEntityBundle:Badge")->findBy(array('idMembre'=>$this->getUser()));
        return $this->render('HomeBadgeBundle:front:MonBadge.html.twig',
         array('badges'=>$Badges


        ));
    }


    public function AffectationAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $date=new \DateTime();
       // $test=$em->getRepository("HomeEntityBundle:Modelbadge")->recupereridmembre($idReclamation);
        $membre = $em->getRepository("HomeUserBundle:User")->find($this->getUser());
       // $membre = $em->getRepository("HomeUserBundle:User")->find($this->getUser());
        $ModelBadge = $em->getRepository("HomeEntityBundle:Modelbadge")->recuperermodelnotifAction("Paris");

       // $idmembre=$em->getRepository("HomeUserBundle:User")->find(1);
        $badge = new Badge();

        if ($request->isMethod('POST')) {

            $badge->setDateBadge($date);
            $badge->setTitre($ModelBadge['titre']);
            $badge->setType("reservation");
            $badge->setDescriptionBadge($ModelBadge['descriptionBadge']);
            $badge->setPath($ModelBadge['path']);
            $badge->setIdMembre($membre);
            $em->persist($badge);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Host&Guest')
                ->setFrom('lilia.gaiji@esprit.tn')
                ->setTo('lilia.gaiji@esprit.tn')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody('Felicitation!! vous avez Gangner un Badge suite a votre reservation  ');
            $this->get('mailer')->send($message);

        }

        return $this->render("HomeBadgeBundle:Back:Affecter.html.twig");
    }








}
