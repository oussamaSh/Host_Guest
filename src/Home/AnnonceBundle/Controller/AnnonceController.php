<?php

namespace Home\AnnonceBundle\Controller;

use Home\AnnonceBundle\Form\ImageType;
use Home\AnnonceBundle\HomeAnnonceBundle;
use Home\AvisBundle\Form\AvisType;
use Home\EntityBundle\Entity\Avis;
use Home\EntityBundle\Entity\Contact;
use Home\EntityBundle\Entity\Equipement;
use Home\EntityBundle\Entity\Logement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Home\EntityBundle\Entity\Image;
use Home\AnnonceBundle\Form\LogementType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;


class AnnonceController extends Controller
{
    public function AccueilAction()
    {
        //$em = $this->getDoctrine()->getManager();
        //$annonce = $em->getRepository("HomeAnnonceBundle:Equipement")->findAll();
        return $this->render('::Accueil.html.twig');

    }


    public function TitreAnnonceAjaxAction()
    {
        $titres=null;

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->findAll();

        foreach ($annonce as $a){
            $titres=$a->getTitreAnnonce();
        }

        $response=new Response(json_encode(array('t'=>$titres)));
        $response->headers->set('Content-Type','application/json');

        return $response;

    }
    public function AccueilAnnoncesAction()
    {

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->findAll();
        $titre = null;
        foreach ($annonce as $a){
            $titre=$a->getTitreAnnonce();
        }


        return $this->render('HomeAnnonceBundle:Pages_Annonce:Accueil_Annonces.html.twig', array(
            "annonces" => $annonce,
            "titres" => $titre,


        ));

    }


    public function findImageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository("HomeEntityBundle:Logement")->findImage();
        return $this->render('HomeAnnonceBundle:Pages_Annonce:Accueil_Annonces.html.twig', array("images" => $image));

    }

    public function AffichageDetailsAnnonceAction(Request $request,$idLogement)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->find($idLogement);
        $annonces = $em->getRepository("HomeEntityBundle:Logement")->findAll();
        $equipement1=$em->getRepository("HomeEntityBundle:Equipement")->find(1);
        $equipement2=$em->getRepository("HomeEntityBundle:Equipement")->find(2);
        $equipement3=$em->getRepository("HomeEntityBundle:Equipement")->find(3);
        $equipement4=$em->getRepository("HomeEntityBundle:Equipement")->find(4);
        $equipement5=$em->getRepository("HomeEntityBundle:Equipement")->find(5);
        $equipement6=$em->getRepository("HomeEntityBundle:Equipement")->find(6);
        $equipement7=$em->getRepository("HomeEntityBundle:Equipement")->find(7);
        $equipement8=$em->getRepository("HomeEntityBundle:Equipement")->find(8);
        $equipement9=$em->getRepository("HomeEntityBundle:Equipement")->find(9);
        $equipement10=$em->getRepository("HomeEntityBundle:Equipement")->find(10);
        $equipement11=$em->getRepository("HomeEntityBundle:Equipement")->find(11);
        $Avis=$em->getRepository("HomeEntityBundle:Avis")->find($idLogement);
        $Aviss=$em->getRepository("HomeEntityBundle:Avis")->findBy(array("idLogement"=>$idLogement));
        $logements=$em->getRepository("HomeEntityBundle:Logement")->find($idLogement);
        $AvisReviews=$em->getRepository("HomeEntityBundle:Avis")->countReviews($idLogement);
        $AvisReviews2=$em->getRepository("HomeEntityBundle:Avis")->countReviews($idLogement);
        $AvisAcceuil=$em->getRepository("HomeEntityBundle:Avis")->countAcceuil($idLogement);
        $AvisqualitePrix=$em->getRepository("HomeEntityBundle:Avis")->countquaitePrix($idLogement);
        $Avisnote=$em->getRepository("HomeEntityBundle:Avis")->countnoteAvis($idLogement);
        $Avisproprete=$em->getRepository("HomeEntityBundle:Avis")->countproprete($idLogement);
        $AvisTotal=$em->getRepository("HomeEntityBundle:Avis")->countTotal($idLogement);
        $AvisReviews3=$em->getRepository("HomeEntityBundle:Avis")->countReviews($idLogement);
        $reservation=$em->getRepository('HomeEntityBundle:Reservation')->findBy(array('idLogement'=>$idLogement));
        $annonceAvis=$em->getRepository("HomeEntityBundle:Logement")->find($idLogement);
        $AddAvis=new Avis();
        $form=$this->createForm(AvisType::class,$AddAvis);
        $form->handleRequest($request);
        $membre = $em->getRepository("HomeUserBundle:User")->find($this->getUser());
        $logement = $em->getRepository("HomeEntityBundle:Logement")->find($idLogement);
        if($form->isValid())
        {

            $AddAvis->setIdLogement($logement);
            $AddAvis->setIdUser($membre);
            $em=$this->getDoctrine()->getManager();
            $em->persist($AddAvis);
            $em->flush();
            return $this->redirectToRoute('Affiche_Details_Annonce', array(
                'idLogement' => $idLogement));





        }


        return $this->render('HomeAnnonceBundle:Pages_Annonce:Details_Annonce.html.twig', array(
            "annonce" => $annonce,
            "annonces" => $annonces,
            "equipement1"=>$equipement1,
            "equipement2"=>$equipement2,
            "equipement3"=>$equipement3,
            "equipement4"=>$equipement4,
            "equipement5"=>$equipement5,
            "equipement6"=>$equipement6,
            "equipement7"=>$equipement7,
            "equipement8"=>$equipement8,
            "equipement9"=>$equipement9,
            "equipement10"=>$equipement10,
            "equipement11"=>$equipement11,
            'Avis'=>$Avis,
            'Aviss'=>$Aviss,
            'reservation'=>$reservation,
            '$nnonceAvis'=>$annonceAvis,
            'logement'=>  $logements,
            'AvisAcceuil'=>$AvisAcceuil,
            'AvisReviews'=>$AvisReviews,
            'AvisReviews2'=>$AvisReviews2,
            'AvisReviews3'=>$AvisReviews3,
            'Avisnote'=>$Avisnote,
            'AvisqualitePrix'=>$AvisqualitePrix,
            'AvisTotal'=>$AvisTotal,
            'Avisproprete'=>$Avisproprete,
            "form"=>$form->createView()


        ));

    }

    public function AffichageMesAnnoncesAction()
    {

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->findBy(array('idMembre' => $this->getUser()->getId()));

        return $this->render('HomeAnnonceBundle:Pages_Annonce:Mes_Annonces.html.twig', array(
            "annonces" => $annonce,

        ));

    }

    public function ContactUsAction(Request $request)
    {
        $message=new Contact();
        $em = $this->getDoctrine()->getManager();

        if($request->isMethod('post')) {
        if ($this->isGranted("ROLE_CLIENT"))
        {
            $message->setIdMembre($this->getUser());
        }
        else
        {
            $message->setIdMembre(null);
        }
        $message->setNomUser($request->get('nom'));
        $message->setEmailUser($request->get('email'));
        $message->setMessage($request->get('message'));

        $em->persist($message);
        $em->flush();
        $this->redirectToRoute('Accueil_Annonces');
        }

        return $this->render('HomeAnnonceBundle:Pages_Annonce:ContactUs.html.twig');
    }
  /*  public function RechercherAnnonceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->findAll();
        return $this->render('HomeAnnonceBundle:Pages_Annonce:Recherche_Annonce.html.twig', array(
            "annonces" => $annonce,

        ));

    }*/
    public function RechercherAction(Request $request){
        $em=$this->getDoctrine()->getManager();


        if($request->isMethod('post')){
            $annonce=$em->getRepository("HomeEntityBundle:Logement")->findEntitiesByString($request->get('input_recherche'));


        }else{
            $annonce=$em->getRepository("HomeEntityBundle:Logement")->findAll();
        }
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $annonce,
            $request->query->getInt('page',1),
            $request->query->getInt('Limit',4)
        );
        return $this->render('HomeAnnonceBundle:Pages_Annonce:rechTest.html.twig', array(
            "annonces"=>$result,


        ));
    }




    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $searchParameter =  $request->get('key');
        $searchParameter2 =  $request->get('key2');
        $searchParameter3 =  $request->get('key3');
        $searchParameter4 =  $request->get('key4');
       // $searchParameter5 =  $request->get('key5');
      //  $searchParameter6 =  $request->get('key6');

        $entities = $em->getRepository('HomeEntityBundle:Logement')->rechercheAnnonce($searchParameter,$searchParameter2,
            $searchParameter3,$searchParameter4/*,$searchParameter5,$searchParameter6*/);
        return $this->render('HomeAnnonceBundle:Pages_Annonce:test2.html.twig', array(
            'annonces' => $entities,
        ));

    }


    public function rechTestAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->findAll();
        $titre=null;

        // die(array_values($annonce)[0]);
       /* foreach ($annonce as $a){
            $titre=$a->getTitreAnnonce();
        }
*/
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $annonce,
            $request->query->getInt('page',1),
            $request->query->getInt('Limit',4)
        );
        return $this->render('HomeAnnonceBundle:Pages_Annonce:rechTest.html.twig', array(
            "annonces"=>$result,


        ));

    }

    public function loadmoreAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("HomeEntityBundle:Logement")->findAll();
        $titre=null;

        return $this->render('HomeAnnonceBundle:Pages_Annonce:loadmoreDiv.html.twig', array(
            'annonces' => $annonce,
        ));

    }

/*
    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getIdLogement()] = $entity->getTitreAnnonce();
        }
        return $realEntities;
    }
*/
    /*public function rechercheAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();

        if($request->isXmlHttpRequest())
        {
            $motcle = '';
            $motcle = $request->request->get('motcle');

            $em = $this->getDoctrine()->getEntityManager();

            if($motcle != '')
            {
                $qb = $em->createQueryBuilder();

                $qb->select('L')
                    ->from('HomeEntityBundle:Logement', 'L')
                    ->where('L.titreAnnonce LIKE :word')
                    ->orWhere('L.paysLogement LIKE :word')
                    ->setParameter('word', '%'.$motcle.'%');

                $query = $qb->getQuery();
                $annonce = $query->getResult();
            }
            else {
                $annonce = $em->getRepository('HomeEntityBundle:Logement')->findAll();
            }

            return $this->container->get('templating')->renderResponse('HomeAnnonceBundle:Pages_Annonce:rechTest.html.twig', array(
                'annonces' => $annonce
            ));
        }
        else {
            $em = $this->getDoctrine()->getEntityManager();
            $annonce = $em->getRepository('HomeEntityBundle:Logement')->findAll();
            return $this->render("HomeAnnonceBundle:Pages_Annonce:rechTest.html.twig",array(
                'annonces'=>$annonce
            ));
        }
    }*/

    public function AjouterAnnonceAction(Request $request)
    {

        $logement=new Logement();
        $form=$this->createForm(LogementType::class,$logement);

        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();

            $maxId = $em->getRepository("HomeEntityBundle:Logement")->maxId();

            $equipement=$em->getRepository("HomeEntityBundle:Logement")->find($maxId);

            $equipement1=$em->getRepository("HomeEntityBundle:Equipement")->find(1);
            $equipement2=$em->getRepository("HomeEntityBundle:Equipement")->find(2);
            $equipement3=$em->getRepository("HomeEntityBundle:Equipement")->find(3);
            $equipement4=$em->getRepository("HomeEntityBundle:Equipement")->find(4);
            $equipement5=$em->getRepository("HomeEntityBundle:Equipement")->find(5);
            $equipement6=$em->getRepository("HomeEntityBundle:Equipement")->find(6);
            $equipement7=$em->getRepository("HomeEntityBundle:Equipement")->find(7);
            $equipement8=$em->getRepository("HomeEntityBundle:Equipement")->find(8);
            $equipement9=$em->getRepository("HomeEntityBundle:Equipement")->find(9);
            $equipement10=$em->getRepository("HomeEntityBundle:Equipement")->find(10);
            $equipement11=$em->getRepository("HomeEntityBundle:Equipement")->find(11);


            if (isset($_POST['chb_Ascenseur']))
                $logement->addEquipement($equipement1);

            if (isset($_POST['chb_Gardien']))

                $logement->addEquipement($equipement2);

            if (isset($_POST['chb_Internet']))
                $logement->addEquipement($equipement3);

            if (isset($_POST['chb_Television']))
                $logement->addEquipement($equipement4);

            if (isset($_POST['chb_secheLinge']))
                $logement->addEquipement($equipement5);

            if (isset($_POST['chb_Interphone']))
                $logement->addEquipement($equipement6);

            if (isset($_POST['chb_SecheCheveux']))
                $logement->addEquipement($equipement7);

            if (isset($_POST['chb_MachineALaver']))
                $logement->addEquipement($equipement8);

            if (isset($_POST['chb_Chauffage']))
                $logement->addEquipement($equipement9);

            if (isset($_POST['chb_Climatisation']))
                $logement->addEquipement($equipement10);

            if (isset($_POST['chb_AnimauxAutorise']))
                $logement->addEquipement($equipement11);




            if ($this->isGranted('ROLE_CLIENT')) {
                $logement->setIdMembre($this->getUser());
            }
            if ($form->get('SUIVANT')->isClicked()) {
                $em->persist($logement);
                $em->flush();
                $em->persist($equipement);
                $em->flush();
            }



            return $this->redirectToRoute('Ajouter_Image_Annonce');
        }

        return $this->render('HomeAnnonceBundle:Pages_Annonce:Ajouter_Annonce.html.twig',array('form'=>$form->createView()));

    }

    public function AjouterImageAnnonceAction(Request $request)
    {

        $image=new Image();

          $formImage=$this->createForm(ImageType::class,$image);

        $formImage->handleRequest($request);

         if ($formImage->isValid())

         {
             $em=$this->getDoctrine()->getManager();
             $maxId = $em->getRepository("HomeEntityBundle:Logement")->maxId();
             $logement=$em->getRepository("HomeEntityBundle:Logement")->find($maxId);

             $image->setIdLogement($logement);
             $em->persist($image);
             $em->flush();
             //}

             return $this->redirectToRoute('Accueil_Annonces');
         }
        return $this->render('HomeAnnonceBundle:Pages_Annonce:Ajouter_Image_Annonce.html.twig',array('form'=>$formImage->createView()));

    }
    public function AjoutEquipementsAction(Request $request)
    {


        //$logement=new Logement();

        $em=$this->getDoctrine()->getManager();
        $maxId = $em->getRepository("HomeEntityBundle:Logement")->maxId();

        $equipement=$em->getRepository("HomeEntityBundle:Logement")->find($maxId);
        $equipement1=$em->getRepository("HomeEntityBundle:Equipement")->find(1);
        $equipement2=$em->getRepository("HomeEntityBundle:Equipement")->find(2);
        $equipement3=$em->getRepository("HomeEntityBundle:Equipement")->find(3);
        $equipement4=$em->getRepository("HomeEntityBundle:Equipement")->find(4);
        $equipement5=$em->getRepository("HomeEntityBundle:Equipement")->find(5);
        $equipement6=$em->getRepository("HomeEntityBundle:Equipement")->find(6);
        $equipement7=$em->getRepository("HomeEntityBundle:Equipement")->find(7);
        $equipement8=$em->getRepository("HomeEntityBundle:Equipement")->find(8);
        $equipement9=$em->getRepository("HomeEntityBundle:Equipement")->find(9);
        $equipement10=$em->getRepository("HomeEntityBundle:Equipement")->find(10);
        $equipement11=$em->getRepository("HomeEntityBundle:Equipement")->find(11);





            if (isset($_POST['chb_Ascenseur']))
                $equipement->addEquipement($equipement1);

            if (isset($_POST['chb_Gardien']))

                $equipement->addEquipement($equipement2);

            if (isset($_POST['chb_Internet']))
                $equipement->addEquipement($equipement3);

            if (isset($_POST['chb_Television']))
                $equipement->addEquipement($equipement4);

            if (isset($_POST['chb_secheLinge']))
                $equipement->addEquipement($equipement5);

            if (isset($_POST['chb_Interphone']))
                $equipement->addEquipement($equipement6);

            if (isset($_POST['chb_SecheCheveux']))
                $equipement->addEquipement($equipement7);

            if (isset($_POST['chb_MachineALaver']))
                $equipement->addEquipement($equipement8);

            if (isset($_POST['chb_Chauffage']))
                $equipement->addEquipement($equipement9);

            if (isset($_POST['chb_Climatisation']))
                $equipement->addEquipement($equipement10);

            if (isset($_POST['chb_AnimauxAutorise']))
                $equipement->addEquipement($equipement11);




            $em->persist($equipement);
            $em->flush();

        return $this->render('HomeAnnonceBundle:Pages_Annonce:Ajouter_Annonce.html.twig',array());

    }

    public function ModifierAnnonceAction(Request $request , $idLogement)
    {

        $em=$this->getDoctrine()->getManager();
        $logement=$em->getRepository("HomeEntityBundle:Logement")->find($idLogement);

        $form=$this->createForm(LogementType::class,$logement);
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($logement);
            $em->flush();


            return $this->redirectToRoute('Mes_Annonces');
        }
        return $this->render('HomeAnnonceBundle:Pages_Annonce:Modifier_Annonce.html.twig',array('form'=>$form->createView()));

    }

    public function ModifierImageAction(Request $request , $idImage)
    {

        $em=$this->getDoctrine()->getManager();
        $image=$em->getRepository("HomeEntityBundle:Image")->find($idImage);
        //$allImage=$em->getRepository('HomeEntityBundle:Image')->findAll();


        $form=$this->createForm(ImageType::class,$image);
        $form->handleRequest($request);
        if ($form->isValid())
        {
           /* foreach ($allImage as $allImages)
            {

            }*/
            $em=$this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
            return $this->redirectToRoute('Mes_Annonces');
        }
        return $this->render('HomeAnnonceBundle:Pages_Annonce:Modifier_Image_Annonce.html.twig',array('form'=>$form->createView()));

    }

    public function SupprimerImageAnnonceAction($idImage)
    {
        $em=$this->getDoctrine()->getManager();
        $image=$em->getRepository("HomeEntityBundle:Image")->findOneBy($idImage);
        $em->remove($image);
        $em->flush();
        $new = $em->getRepository("HomeEntityBundle:Image")->findBy(array('idLogement' => $image));
        return $this->render('HomeAnnonceBundle:Pages_Annonce:Suppression_image_annonce.html.twig', array(
            'annonce' => $new,
        ));

    }
    public function SupprimerAnnonceAction($idLogement)
    {
        $em=$this->getDoctrine()->getManager();
        $logement=$em->getRepository("HomeEntityBundle:Logement")->find($idLogement);
        $em->remove($logement);
        $em->flush();
        $new = $em->getRepository("HomeEntityBundle:Logement")->findBy(array('idMembre' => $this->getUser()->getId()));
        return $this->render('HomeAnnonceBundle:Pages_Annonce:SuppressionAjax.html.twig', array(
            'annonces' => $new,
        ));
    }
    public function SupprimerAnnonceBackAction($idLogement)
    {
        $em=$this->getDoctrine()->getManager();
        $logement=$em->getRepository("HomeEntityBundle:Logement")->find($idLogement);
        $em->remove($logement);
        $em->flush();
        $new = $em->getRepository("HomeEntityBundle:Logement")->findAll();
        return $this->render('HomeAnnonceBundle:Back_office:Rech_Back_Ajax.html.twig', array(
            'annonces' => $new,
        ));
    }
    public function afterDeleteAction()
    {
        $em=$this->getDoctrine()->getManager();
        $new = $em->getRepository("HomeEntityBundle:Logement")->findBy(array('idMembre' => $this->getUser()->getId()));
        return $this->render('HomeAnnonceBundle:Pages_Annonce:SuppressionAjax.html.twig', array(
            'annonces' => $new,
        ));
    }

    public function StatistiquesAnnoncesAction()
    {
        //$em = $this->getDoctrine()->getManager();
        //$annonce = $em->getRepository("HomeAnnonceBundle:Equipement")->findAll();
        return $this->render('HomeAnnonceBundle:Back_office:Statistiques_Annonces.html.twig');

    }

   public function RechercheBackAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $searchParameter =  $request->get('key');
        $searchParameter2 =  $request->get('key2');

        $entities = $em->getRepository('HomeEntityBundle:Logement')->rechercheAnnonceBack($searchParameter,$searchParameter2);


        return $this->render('HomeAnnonceBundle:Back_office:Rech_Back_Ajax.html.twig', array(
            'annonces' => $entities,
        ));
    }

    public function AffichageListeAnnoncesAction()
    {
        $em = $this->getDoctrine()->getManager();

            $annonce = $em->getRepository("HomeEntityBundle:Logement")->findAll();

       return $this->render('HomeAnnonceBundle:Back_office:Liste_Annonces.html.twig', array("annonces" => $annonce));
    }

    public function SlideshowPopupAction($idLogement)
    {

        $em = $this->getDoctrine()->getManager();

        $annonce = $em->getRepository("HomeEntityBundle:Logement")->find($idLogement);

        return $this->render('HomeAnnonceBundle:Pages_Annonce:slideshow-popup.html.twig', array("annonce" => $annonce));
    }


    //signaler Front
    public function  SignalerAvisAction($id,$idlogement)

    {
        $em=$this->getDoctrine()->getManager();
        $Avis=$em->getRepository("HomeEntityBundle:Avis")->Signaler($id);
        $em->flush();
        return $this->redirectToRoute('Affiche_Details_Annonce', array('idLogement' => $idlogement));



    }
}
