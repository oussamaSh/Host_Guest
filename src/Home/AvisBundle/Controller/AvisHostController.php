<?php

namespace Home\AvisBundle\Controller;
use Home\AvisBundle\Form\AvishostType;
use Symfony\Component\HttpFoundation\Request;
use Home\EntityBundle\Entity\Avishost;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use  Home\AvisBundle\Repository\AvisHostRepository;

class AvisHostController extends Controller
{


    public function AjouterHostAction(Request $request,$idMembre)
    {   $em=$this->getDoctrine()->getManager();
        $AvishostADD=new Avishost();
        $Host=$em->getRepository("HomeEntityBundle:user")->find($idMembre);
        $form=$this->createForm(AvishostType::class,$AvishostADD);
        $Guest = $em->getRepository("HomeUserBundle:User")->find($this->getUser());
        $form->handleRequest($request);
        echo $Host;
        if($form->isValid())
        {
            $AvishostADD->setIdGuest($Guest);
            $AvishostADD->setIdHost($Host);
            $em=$this->getDoctrine()->getManager();
            $em->persist($AvishostADD);
            $em->flush();
           // return $this->redirectToRoute("AvisHostFront_Route");
          //  return $this->redirectToRoute('AvisRoute1', array(
          //  'idMembre' => $idMembre));
        }
        return $this->render("HomeAvisBundle:Front:Host.html.twig",array("form"=>$form->createView()));
    }

    public function ShowAction()
    {   $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avishost")->findAll();
        return $this->render("HomeAvisBundle:Back:ShowAvisHost.html.twig",array("Avis"=>$Avis));
    }

//Front show host
/*
    public function ShowFrontHostAction($idMembre)
    {   $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avishost")->findAll();
        $AvisReactiviteHost=$em->getRepository("HomeEntityBundle:Avishost")->countAcceuilHost($idMembre);
        $AvisAcceuilHost=$em->getRepository("HomeEntityBundle:Avishost")->countReactiviteHost($idMembre);
        $AvisReviewsHost=$em->getRepository("HomeEntityBundle:Avishost")->countReviews($idMembre);
        $reservation=$em->getRepository('HomeEntityBundle:Reservation')->findAll();
        return $this->render('HomeAvisBundle:Front:AvisHost.html.twig',array('Avis'=>$Avis,
            'Reservations'=>$reservation,
            'AvisReactiviteHost'=>$AvisReactiviteHost,
            'AvisAcceuilHost'=>$AvisAcceuilHost,
            'AvisReviewsHost'=>$AvisReviewsHost
        ));
    }*/
    public function ShowFrontHostAction(Request $request ,$idMembre)
    {   $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avishost")->findBy(array("idMembre"=>$idMembre));
        $AvisAcceuilHost=$em->getRepository("HomeEntityBundle:Avishost")->countAcceuilHost($idMembre);
        $AvisReactiviteHost=$em->getRepository("HomeEntityBundle:Avishost")->countReactiviteHost($idMembre);
        $AvisTotal=$em->getRepository("HomeEntityBundle:Avishost")->countTotalHost($idMembre);
        $AvisTotalhost= $AvisAcceuilHost+$AvisReactiviteHost ;
        $AvisReviewsHost=$em->getRepository("HomeEntityBundle:Avishost")->countReviews($idMembre);
        $AvisReviews3=$em->getRepository("HomeEntityBundle:Avishost")->countReviews($idMembre);
        $Hosts=$em->getRepository("HomeUserBundle:User")->find($idMembre);
        $reservation=$em->getRepository('HomeEntityBundle:Reservation')->findBy(array('idMembre'=>$idMembre));

        $AvishostADD=new Avishost();
        $Host=$em->getRepository("HomeUserBundle:User")->findOneBy(array('id'=>$idMembre));
        $form=$this->createForm(AvishostType::class,$AvishostADD);
        $Guest = $em->getRepository("HomeUserBundle:User")->find($this->getUser());
        $form->handleRequest($request);

        if($form->isValid())
        {
            $AvishostADD->setIdGuest($Guest);
            $AvishostADD->setIdMembre($Host);
            $em=$this->getDoctrine()->getManager();
            $em->persist($AvishostADD);
            $em->flush();
        }
        return $this->render('HomeAvisBundle:Front:Host.html.twig',array(
            'Avis'=>$Avis,
            'reservation'=>$reservation,
            'AvisTotal'=>$AvisTotal,
            'Host'=>$Hosts,
            'AvisTotalhost'=>$AvisTotalhost,
            'AvisReviews3'=>$AvisReviews3,
            'AvisReactiviteHost'=>$AvisReactiviteHost,
            'AvisAcceuilHost'=>$AvisAcceuilHost,
            'AvisReviewsHost'=>$AvisReviewsHost,
            "form"=>$form->createView()
        ));
    }

    //SIGNALER UN AVIS HOST
  /*
    public function  SignalerAvisHostAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avishost")->SignalerHost($id);
        $em->flush();
       // return $this->render("HomeAvisBundle:Front:AvisHost.html.twig",array("Avis"=>$Avis));
        return $this->redirectToRoute("AvisHostFront_Route");
idMembre
}
*/
    //SIGNALER UN AVIS HOST

      public function  SignalerAvisHostAction($id,$idMembre)
      {
          $em=$this->getDoctrine()->getManager();
          $Avis=$em->getRepository("HomeEntityBundle:Avishost")->SignalerHost($id);
          $em->flush();
          return $this->redirectToRoute('AvisHostFront_Route',array('idMembre' => $idMembre));

  }

//les Signalement des host

    public function ShowSignalementAction()
    {   $em=$this->getDoctrine()->getManager();
        $AvisHost=$em->getRepository("HomeEntityBundle:Avishost")->findSignalementHost();
        return $this->render("HomeAvisBundle:Back:AvisSignaler.html.twig",array("AvisHost"=>$AvisHost));
    }



    //SUPPRIMER HOST BACK
    public function supprimerHostAction($id)

    {
        $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avishost")->findOneBy(array("idHost"=>$id));
        if (!$Avis) {
            throw $this->createNotFoundException('No Avis found for id '.$id);
        }

        $em->remove($Avis);
        $em->flush();
        return $this->redirectToRoute("Show_AvisHost");//route show host

    }


}
