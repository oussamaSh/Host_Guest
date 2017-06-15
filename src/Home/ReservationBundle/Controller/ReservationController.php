<?php

namespace Home\ReservationBundle\Controller;
use JMS\Payment\CoreBundle\Form\ChoosePaymentMethodType;
use Home\EntityBundle\Entity\Logement;
use Home\EntityBundle\Entity\Reservation;
use Home\ReservationBundle\Form\AjoutReservation;
use Home\ReservationBundle\Form\ReservationType;
use Home\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\Payment\CoreBundle\PluginController\Result;
use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;
use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use Symfony\Component\HttpFoundation\Response;
use Ob\HighchartsBundle\Highcharts\Highchart;

class ReservationController extends Controller
{
    //////////////////BACK
    public function AfficherListeReservatonAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reservations=$em->getRepository("HomeEntityBundle:Reservation")->findAll();

        return $this->render('HomeReservationBundle:Back_office:List_Reservations.html.twig',array("reservations"=>$reservations));

    }
    function SupprimerReservationAction($idReservation){

        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository("HomeEntityBundle:Reservation")->find($idReservation);
        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('Afficher_Reservations');

    }
    function RechercheReservationAction(Request $request){
        $reservation=new Reservation();
        $em=$this->getDoctrine()->getManager();
        $reservations=$em->getRepository("HomeEntityBundle:Reservation")->findAll();
        $Form=$this->createForm(ReservationType::class,$reservation);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $etat=$reservation->getEtat();
            $reservations=$em->getRepository("HomeEntityBundle:Reservation")->rechercherReservation($etat);


        }
        return $this->render("HomeReservationBundle:Back_office:Recherche_Reservation.html.twig", array("Form"=>$Form->createView(),'reservations'=>$reservations));

    }

    public function AfficherListeFactureBackAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reservations=$em->getRepository("HomeEntityBundle:Reservation")->findAll();

        return $this->render('HomeReservationBundle:Back_office:List_Factures.html.twig',array("reservation"=>$reservations));

    }


    public function statreservationAction(){

        $em=$this->getDoctrine()->getManager();

        $reservation=$em->getRepository("HomeEntityBundle:Reservation")->findAll();


        $prix1=0;
        $prix2=0;
        $prix3=0;
        $prix4=0;
        $prix5=0;
        $prix6=0;
        foreach ($reservation as $reservations)
        {
            if(($reservations->getPrixTot())<"200")
            {
                $prix1=$prix1+1;
            }
            elseif(($reservations->getPrixTot())>"200" and ($reservations->getPrixTot())<"400")
            {
                $prix2=$prix2+1;
            }
            elseif(($reservations->getPrixTot())>"400" and ($reservations->getPrixTot())<"600")
            {
                $prix3=$prix3+1;
            }
            elseif(($reservations->getPrixTot())>"600" and ($reservations->getPrixTot())<"800")
            {
                $prix4=$prix4+1;
            }
            elseif(($reservations->getPrixTot())>"800" and ($reservations->getPrixTot())<"1000")
            {
                $prix5=$prix5+1;
            }
            elseif(($reservations->getPrixTot())>"1000")
            {
                $prix6=$prix6+1;
            }

        }

        $a=$prix1;
        $b=$prix2;
        $c=$prix3;
        $d=$prix4;
        $e=$prix5;
        $f=$prix6;
        $sellsHistory = array(

            array(
                 "name" => "NOMBRE DE RESERVATIONS",
                 "data" => array($a, $b, $c, $d,$e,$f)
            ),

        );

        $dates = array(
            "<200", "200-400", "400-600", "600-800" , "800-1000", "1000>"
        );

        $ob = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $ob->chart->renderTo('barchart');
        $ob->title->text('NOMBRE DE RESERVATION SELON LE PRIX ');
        $ob->chart->type('column');

        $ob->yAxis->title(array('text' => "NOMBRE DE RESERVATIONS"));

        $ob->xAxis->title(array('text' => "PRIX(en DT)"));
        $ob->xAxis->categories($dates);

        $ob->series($sellsHistory);

        return $this->render('HomeReservationBundle:Back_office:Statistique_Reservation.html.twig', array(
            'barchart' => $ob
        ));
    }


    public function statFactureAction()
    {

        $em=$this->getDoctrine()->getManager();

        $reservation=$em->getRepository("HomeEntityBundle:Reservation")->findAll();


        $prix1=0;
        $prix2=0;
        $prix3=0;
        $prix4=0;
        $prix5=0;
        $prix6=0;
        foreach ($reservation as $reservations){

            $datedeb=$reservations->getDateDebut();
            $datefin=$reservations->getDateFin();
            $difference= $datedeb ->diff($datefin) ;
            $diff=$difference->format('%d');



            if(($diff)<=2)
            {
                $prix1=$prix1+1;
            }
            elseif(($diff)>2 and ($diff)<4)
            {
                $prix2=$prix2+1;
            }
            elseif(($diff)>=4 and ($diff)<6)
            {
                $prix3=$prix3+1;
            }
            elseif(($diff)>=6 and ($diff)<8)
            {
                $prix4=$prix4+1;
            }
            elseif(($diff)>=8 and ($diff)<10)
            {
                $prix5=$prix5+1;
            }
            elseif(($diff)>=10)
            {
                $prix6=$prix6+1;
            }
        }

        $a=$prix1;
        $b=$prix2;
        $c=$prix3;
        $d=$prix4;
        $e=$prix5;
        $f=$prix6;
        $sellsHistory = array(

            array(
                "name" => "NOMBRE DE NUITS",
                "data" => array($a,$b, $c,$d ,$e,$f)
            ),

        );

        $dates = array(
            "2<", "2-4", "4-6", "6-8", "8-10", "10>"
        );

        $ob = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $ob->chart->renderTo('linechart');
        $ob->title->text('NOMBRE RESERVATIONS SELON LE NOMBRE DES NUITS');

        $ob->yAxis->title(array('text' => "NOMBRE DE RESERVATIONS"));

        $ob->xAxis->title(array('text'  => "NOMBRE DE NUITS"));
        $ob->xAxis->categories($dates);

        $ob->series($sellsHistory);

        return $this->render('HomeReservationBundle:Back_office:Statistique_facture.html.twig', array(
            'linechart' => $ob
        ));
    }






///////////////////FRONT
    public function ajouterReservation2Action(Request $request)
    {
        $Reservation=new Reservation();
        $logements=new Logement();
        $em=$this->getDoctrine()->getManager();
        $Reservation->setIdLogement($em->getRepository("HomeEntityBundle:Logement")->find(5));
        $Reservation->setIdMembre($this->getUser());
        $nonconfirme="En attente de confirmation";

        $date=new \DateTime($request->get('dateDebut'));
        $date1=new \DateTime($request->get('dateFin'));
        $difference= $date ->diff($date1) ;
        $prixunitaire=$em->getRepository("HomeEntityBundle:Logement")->find(5)->getPrixLogement();
        $prixtotal= $difference->format('%d')*$prixunitaire + ($difference->format('%d')*$prixunitaire*0.1);


        if($request->isMethod('POST')){

            $Reservation->setDateDebut($date);
            $Reservation->setDateFin($date1);
            $Reservation->setEtat($nonconfirme);
            $Reservation->setPrixTot($prixtotal);
            $em->persist($Reservation);
            $em->flush();
            return $this->redirectToRoute('Afficher_Reservation_front_Host');

        }

        return $this->render("HomeReservationBundle:Front_office:Ajout_reservation.html.twig",array("logement"=>$logements));
    }


   /* public function AfficherLogementAction()
    {
        $em=$this->getDoctrine()->getManager();
        $logements=$em->getRepository("HomeEntityBundle:Logement")->find(5);

        return $this->render('HomeReservationBundle:Front_office:Ajout_reservation.html.twig',array("logement"=>$logements));

    }*/




    private function createPayment($reservation)
    {
        $instruction = $reservation->getPaymentInstruction();
        $pendingTransaction = $instruction->getPendingTransaction();

        if ($pendingTransaction !== null) {
            return $pendingTransaction->getPayment();
        }

        $ppc = $this->get('payment.plugin_controller');
        $amount = $instruction->getAmount() - $instruction->getDepositedAmount();

        return $ppc->createPayment($instruction->getId(), $amount);
    }
    /**
     * @Route("/{id}/payment/create")
     */
    public function paymentCreateAction(Reservation $reservation)
    {

        $payment = $this->createPayment($reservation);
        echo $payment->getId();
        $ppc = $this->get('payment.plugin_controller');
        echo 'aaaaa';
        $result = $ppc->approveAndDeposit($payment->getId(), $payment->getTargetAmount());
        echo 'aaaaa';
        if ($result->getStatus() === Result::STATUS_SUCCESS) {
            echo 'status success';
            return $this->redirect($this->generateUrl('Afficher_Reservations', [
                'id' => $reservation->getIdReservation(),
            ]));
        }
        if ($result->getStatus() === Result::STATUS_PENDING) {
            echo 'status pending';
            $ex = $result->getPluginException();

            if ($ex instanceof ActionRequiredException) {
                $action = $ex->getAction();

                if ($action instanceof VisitUrl) {
                    return $this->redirect($action->getUrl());
                }
            }
            }
        throw $result->getPluginException();

        // In a real-world application you wouldn't throw the exception. You would,
        // for example, redirect to the showAction with a flash message informing
        // the user that the payment was not successful.
    }
    /**
     * @Route("/{id}/payment/complete")
     */
    public function paymentCompleteAction(Reservation $order)
    {
        return new Response('Payment complete');
    }

    public function modifierReservationAction(Request $request,$idReservation)

    {
        $em = $this->getDoctrine()->getManager();

        $Reservation = $em->getRepository("HomeEntityBundle:Reservation")->findOneBy(array("idReservation" => $idReservation));
        $date=new \DateTime($request->get('dateDebut'));
        $date1=new \DateTime($request->get('dateFin'));
        $difference= $date ->diff($date1) ;
        $prixunitaire=$em->getRepository("HomeEntityBundle:Logement")->find(5)->getPrixLogement();
        $prixtotal= $difference->format('%d')*$prixunitaire + ($difference->format('%d')*$prixunitaire*0.1);


        if($request->isMethod('POST')){

            $Reservation->setDateDebut($date);
            $Reservation->setDateFin($date1);
            $Reservation->setPrixTot($prixtotal);
            $em->persist($Reservation);
            $em->flush();
            return $this->redirectToRoute('Afficher_Reservation_front_Host');

        }

        return $this->render("HomeReservationBundle:Front_office:Modifier_reservation.html.twig",   array("reservation"=>$Reservation));
    }

    public function AfficherReservationguestAction()
    {

        $em=$this->getDoctrine()->getManager();
        $logements=$em->getRepository("HomeEntityBundle:Logement")->findBy(array('idMembre' => $this->getUser()->getId()));;


        return $this->render("HomeReservationBundle:Front_office:Afficher_reservationguest.html.twig" , array("logement"=>$logements));

    }



    public function AfficherReservationhostAction()
    {

        $em=$this->getDoctrine()->getManager();
        $reservations=$em->getRepository("HomeEntityBundle:Reservation")->findBy(array('Id_membre' => $this->getUser()->getId()));;


        return $this->render("HomeReservationBundle:Front_office:Afficher_reservationhost.html.twig" , array("reservation"=>$reservations));

    }
    public function ConfirmerReservationhostAction(Request $request,$idReservation)
    {
        $em=$this->getDoctrine()->getManager();
        $Reservation = $em->getRepository("HomeEntityBundle:Reservation")->findOneBy(array("idReservation" => $idReservation));

        $confirmer="Confirmé";

        $form = $this->createForm(ChoosePaymentMethodType::class, null, [
            'amount'   => $Reservation->getPrixTot(),
            'currency' => 'EUR',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ppc = $this->get('payment.plugin_controller');
            $ppc->createPaymentInstruction($instruction = $form->getData());

            $Reservation->setPaymentInstruction($instruction);
            $Reservation->setEtat($confirmer);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Reservation);
            $em->flush();

            return $this->redirect($this->generateUrl('Payer_Reservation', [
                'id' => $Reservation->getIdReservation(),
            ]));
        }
        return $this->render("HomeReservationBundle:Front_office:Confirmation_reservation.html.twig",array("reservation"=>$Reservation,"form"=>$form->createView()));

    }
    public function RefuserReservationhostAction(Request $request,$idReservation)
    {
        $em=$this->getDoctrine()->getManager();
        $Reservation = $em->getRepository("HomeEntityBundle:Reservation")->findOneBy(array("idReservation" => $idReservation));

        $confirmer="Annulé";
        $request->isMethod('POST');
        $Reservation->setEtat($confirmer);
        $em->persist($Reservation);
        $em->flush();
        return $this->redirectToRoute('Afficher_Reservation_front_Host');
    }


    public function AfficherFactureAction($idReservation)
    {
        $em = $this->getDoctrine()->getManager();
        $Reservation = $em->getRepository("HomeEntityBundle:Reservation")->findOneBy(array("idReservation" => $idReservation));

        return $this->render("HomeReservationBundle:Front_office:Afficher_facture.html.twig" ,   array("reservation"=>$Reservation));

    }


    public function pdfAction($idReservation)
    {

        $em = $this->getDoctrine()->getManager();
        $Reservation = $em->getRepository("HomeEntityBundle:Reservation")->findOneBy(array("idReservation" => $idReservation));

        $html = $this->renderView('HomeReservationBundle:Front_office:pdf_facture.html.twig', array(
            "reservation"=>$Reservation
        ));



        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   =>  'attachment; filename="Facture.pdf"'
            )
        );
    }

}
