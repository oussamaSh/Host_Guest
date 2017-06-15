<?php

namespace Home\BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;

class StatistiqueController extends Controller
{
    public function chartAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $em= $this->container->get('doctrine')->getEntityManager();
        $produits = $em->getRepository('HomeEntityBundle:Produit')->findAll();
        $Stock=0;
        foreach($produits as $produit) {
            $Stock=$Stock+$produit->getQuantiteProduit();
        }
        $data= array();
        foreach($produits as $produit) {
            $stat=array();
            array_push($stat,$produit->getNomProduit(),(($produit->getQuantiteProduit()) *100)/$Stock);
            //var_dump($stat);
            array_push($data,$stat);
        }

        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('HomeBoutiqueBundle:Back_office:stat.html.twig', array('chart' => $ob));
    }
}
