<?php

namespace Home\FavorisBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use ForumBundle\Form\MediaForm;
use Home\EntityBundle\Entity\Message;
use Home\FavorisBundle\Entity\Album;
use Home\FavorisBundle\Entity\ChatMessage;
use Home\FavorisBundle\Entity\Media;
use Home\FavorisBundle\Entity\PostUserLike;
use Home\FavorisBundle\Form\MediaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Event\ConsoleEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Home\FavorisBundle\Entity\Status;
use Home\FavorisBundle\Entity\PostUserComment;
use Symfony\Component\HttpFoundation\Response;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Home\FavorisBundle\Form\AlbumForm;


class FavorisController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function AfficherFeedFavorisAction(Request $request)
    {
        $status = new Status();
        $User = $this->getUser();
        $em=$this->getDoctrine()->getManager();


        $feed=$em->getRepository("HomeFavorisBundle:Status")->findAll();
        $posts=$em->getRepository("HomeFavorisBundle:PostUser")->findAll();
        $messages=$em->getRepository("HomeFavorisBundle:ChatMessage")->findAll();
        return $this->render('HomeFavorisBundle:Favoris:feed.html.twig', array("feeds"=>$feed,"posts"=>$posts,"messages"=>$messages));

    }

    public function Ajouter_commentaireAction($id,$contenu)
    {
        $em=$this->getDoctrine()->getManager();
        $status = $em->getRepository("HomeFavorisBundle:Status")->find($id);
        $comment = new PostUserComment();
        $comment->setContenu($contenu);
        $comment->setPostUser($status);
        $comment->setDateAjout(date_create());
        $comment->setUser($this->getUser());
        $em->persist($comment);
        $em->flush();
        $comments= $em->getRepository("HomeFavorisBundle:Status")->find($id);
        return $this->render('HomeFavorisBundle:Favoris:Comments_Ajax.html.twig', array("status"=>$status));
    }
    public function LikePostUserAction(Request $request)
    {
        $id=$_GET['id'];
        $em=$this->getDoctrine()->getManager();
        $status = $em->getRepository("HomeFavorisBundle:PostUser")->find($id);
        $like = new PostUserLike();
        $like->setPostUser($status);
        $like->setDateAjout(date_create());
        $like->setUser($this->getUser());
       // $status->addLike($like);
        $em->persist($like);
        $em->flush();

        return $this->render('HomeFavorisBundle:Favoris:Likes_Ajax.html.twig', array("status"=>$status));
    }

    public function unLikePostUserAction()
    {
        $id =$_GET['id'];
        $em=$this->getDoctrine()->getManager();
        $status = $em->getRepository("HomeFavorisBundle:PostUser")->find($id);
        $userlike = $em->getRepository("HomeFavorisBundle:PostUserLike")->findOneby(array('postUser'=>$status,'user'=>$this->getUser()));
        $em->remove($userlike);
        $em->flush();

        return $this->render('HomeFavorisBundle:Favoris:Likes_Ajax.html.twig', array("status"=>$status));
    }
    public function AfficherProfileUserAction(Request $request,$id){

        $em=$this->getDoctrine()->getManager();
        $user =  $em->getRepository("HomeUserBundle:User")->find($id);
        $follow= $em->getRepository("HomeEntityBundle:Favoris")->findOneBy(array("idMembre"=>$this->getUser(),"idMembreFavori"=>$user));
        return $this->render('HomeFavorisBundle:Favoris:profile.html.twig',array("user"=>$user,"follow"=>$follow));

    }

    public function AjouterStatusAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $status = new Status();
        $status->setUser($this->getUser());
        $status->setDateAjout(date_create());
        $contenu= $request->request->get('status');
        $status->setContenu(trim($request->request->get('status')));
        //$count=$em->getRepository("HomeUserBundle:Status")->findBy(array("user"=>$this->getUser()))->count;
        //if($count<10){
            $em->persist($status );
            $em->flush();
        //}

        return $this->render('HomeFavorisBundle:Favoris:ajoutstatus.html.twig',array("status"=>$status));
    }

    public function SupprimerStatusAction(Request $request){
        $id =$_GET['id'];
        $em=$this->getDoctrine()->getManager();
        $status=$em->getRepository("HomeFavorisBundle:PostUser")->find($id);
        $em->remove($status );
        $em->flush();
        return $this->redirect($this->generateUrl('Afficher_Feed_Favoris'));
    }

    public function Jquery_uploaderAction(Request $request){

        return $this->render('@HomeFavoris/Favoris/jqueryuploadtest.html.twig');

    }
    public function UploaderAction(Request $request){

    }
    public function AjouterAlbumAction(Request $request){
        $nom =$_GET['name'];
        $album=new Album();
        $album->setTitre($nom);
        $album->setUser($this->getUser());
        $album->setDateAjout(date_create());
        $em=$this->getDoctrine()->getManager();
        $em->persist($album);
        $em->flush();
        return $this->render('HomeFavorisBundle:Favoris:album.html.twig',array("album"=>$album));
    }
    
    public function AjouterMediaAction(Request $request){
        //$files =$_FILES['file'];
        $em=$this->getDoctrine()->getManager();
        $output = '';

        $post = $request->request->all();
        var_dump($post);
       if(is_array($_FILES))
        {
            foreach ($_FILES['files%5B%5D']['name'] as $name => $value)
            {
                $file_name = explode(".", $_FILES['files']['name'][$name]);
                $allowed_ext = array("jpg", "jpeg", "png", "gif");
                if(in_array($file_name[1], $allowed_ext))
                {
                    $new_name = md5(rand()) . '.' . $file_name[1];
                    $sourcePath = $_FILES['files']['tmp_name'][$name];
                    $targetPath = "upload/".$new_name;
                    if(move_uploaded_file($sourcePath, $targetPath))
                    {
                        $output .= '<img src="'.$targetPath.'" width="150px" height="180px" />';
                    }

                }
            }
            echo $output;
        }


        $images=$em->getRepository("HomeFavorisBundle:Media")->findBy(array("album"=>$id));

        return $this->render('HomeFavorisBundle:Favoris:afficher_album.html.twig',array("images"=>$images));
    }

    public function AfficherbackCommentaireAction(Request $request){

    $em=$this->getDoctrine()->getManager();
    $commentaires=$em->getRepository("HomeFavorisBundle:PostUserComment")->findAll();

    return $this->render('HomeFavorisBundle:Favoris:back_commentaire.html.twig',array("commentaires"=>$commentaires));
    }

    public function AfficherStatAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $status=$em->getRepository("HomeFavorisBundle:status")->findAll();
        // Chart
        $d0=0;$d1=0;$d2=0;$d3=0;$d4=0;$d5=0;$d6=0;
        foreach ($status as $statu) {
            $dw = date( "w", $statu->getDateAjout()->getTimestamp());
            if ($dw==0)
                $d0++;
            elseif ($dw==1)
                $d1++;
            elseif ($dw==2)
                $d2++;
            elseif ($dw==3)
                $d3++;
            elseif ($dw==4)
                $d4++;
            elseif ($dw==5)
                $d5++;
            else
                $d6++;
        }

        $series = array(
            array("name" => "nbr de status",    "data" => array($d0,$d1,$d2,$d3,$d4,$d5,$d6))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Nombre de status par jour');
        $ob->xAxis->title(array('text'  => "Jour de la semaine"));
        $ob->yAxis->title(array('text'  => "Nombre de status"));
        $ob->series($series);

        return $this->render('HomeFavorisBundle:Favoris:Statfavoris.html.twig',array('chart' => $ob));
    }

    public function SendMessageAction(Request $request){
        $contenu =$_GET['content'];
        $em=$this->getDoctrine()->getManager();
        $message = new ChatMessage();
        $message->setDateAjout(date_create());
        $message->setUser($this->getUser());
        $message->setContenu($contenu);
        $em->persist($message);
        $em->flush();
        //$messages=$em->getRepository("HomeFavorisBundle:ChatMessage")->findAll();
        return $this->render('HomeFavorisBundle:Favoris:ajoutmessage.html.twig',array('message' => $message));
    }
    public function refreshAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $messages=$em->getRepository("HomeFavorisBundle:ChatMessage")->findAll();
        return $this->render('HomeFavorisBundle:Favoris:allmessages.html.twig',array('messages' => $messages));
    }

}
