<?php

namespace Home\BadgeBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Home\EntityBundle\Entity\Badge;
use Ob\HighchartsBundle\Highcharts\Highchart;

class statController extends Controller
{

    public function chartAction()
    {
        $em=$this->getDoctrine()->getManager();
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Statistique sur les Badges Affecter par Type : ');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $Badge=$em->getRepository("HomeEntityBundle:Badge")->findAll();
        $Stock=0;
        $ville=0;
        $reservation=0;
        foreach ($Badge as $Badge)
        {
            if(($Badge->getType())=="ville")
            {
                $ville=$ville+1;
            }
            elseif(($Badge->getType())=="reservation")
            {
                $reservation=$reservation+1;
            }
            $Stock=$Stock+1;
        }
        $b=($reservation*100)/$Stock;
        $a=($ville*100)/$Stock;
        $data = array(
            array('reservation',$b),
            array('ville', $a),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('HomeBadgeBundle:Back:stat.html.twig', array(
            'chart' => $ob));
    }
}
