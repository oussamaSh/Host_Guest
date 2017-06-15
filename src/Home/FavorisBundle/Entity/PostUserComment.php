<?php

namespace Home\FavorisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostUserComment
 *
 * @ORM\Table(name="post_user_comment")
 * @ORM\Entity(repositoryClass="Home\FavorisBundle\Repository\PostUserCommentRepository")
 */
class PostUserComment extends PostUser
{


    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;


    /**
     * @ORM\ManyToOne(targetEntity="PostUser", inversedBy="comments")
     * @ORM\JoinColumn(name="post_user_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $postUser;


    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return PostUserComment
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Get dateAjout
     *
     * @return \string
     */
    public function getDateAjoutString()
    {
        return $this->dateAjout->format('d M Y');
    }

    /**
     * Set postUser
     *
     * @param \Home\FavorisBundle\Entity\PostUser $postUser
     *
     * @return PostUserComment
     */
    public function setPostUser(\Home\FavorisBundle\Entity\PostUser $postUser = null)
    {
        $this->postUser = $postUser;

        return $this;
    }
    public function getClassType(){
        $a = (string)$this->get_class();
        return $a;
    }
    /**
     * Get postUser
     *
     * @return \Home\FavorisBundle\Entity\PostUser
     */
    public function getPostUser()
    {
        return $this->postUser;
    }
}
