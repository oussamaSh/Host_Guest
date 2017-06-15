<?php
/**
 * Created by PhpStorm.
 * User: Oussama Shili
 * Date: 10/04/2017
 * Time: 01:06
 */

namespace Home\AnnonceBundle\Controller;


use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatAnnonceController extends Controller
{
    public function chartAction()
    {
        $em=$this->getDoctrine()->getManager();
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Statistiques sur le type de logements publié sur Host&Guest.tn : ');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $logements=$em->getRepository("HomeEntityBundle:Logement")->findAll();
        $total=0;
        $maison=0;
        $appartement=0;
        $studio=0;
        foreach ($logements as $logement)
        {
            if(($logement->getTypeLogement())=="Maison")
            {
                $maison=$maison+1;
            }
            elseif(($logement->getTypeLogement())=="Appartement")
            {
                $appartement=$appartement+1;
            }
            elseif(($logement->getTypeLogement())=="Studio")
            {
                $studio=$studio+1;
            }
            $total=$total+1;
        }
        $b=($maison*100)/$total;
        $a=($appartement*100)/$total;
        $c=($studio*100)/$total;
        $data = array(
            array('Maison',$b),
            array('Appartement', $a),
            array('Studio', $c),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('@HomeAnnonce/Back_office/Statistiques_Annonces.html.twig', array(
            'chart' => $ob));
    }


    }