<?php

namespace Home\FavorisBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"postuser" ="PostUser" ,"status" = "Status", "media" = "Media","album" = "Album","postusercomment"="PostUserComment"})
 */
abstract class PostUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Home\UserBundle\Entity\User", inversedBy="posts")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="Id_user", referencedColumnName="id")
     * })
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    protected $dateAjout;

    /**
     * @ORM\OneToMany(targetEntity="PostUserComment", mappedBy="postUser")
     */

    protected $comments;
    /**
     * @ORM\OneToMany(targetEntity="PostUserLike", mappedBy="postUser")
     */
    protected $likes;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Home\UserBundle\Entity\User $user
     *
     * @return PostUser
     */
    public function setUser(\Home\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Home\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }




    /**
     * Add comment
     *
     * @param \Home\FavorisBundle\Entity\PostUserComment $comment
     *
     * @return PostUser
     */
    public function addComment(\Home\FavorisBundle\Entity\PostUserComment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Home\FavorisBundle\Entity\PostUserComment $comment
     */
    public function removeComment(\Home\FavorisBundle\Entity\PostUserComment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add like
     *
     * @param \Home\FavorisBundle\Entity\PostUserLike $like
     *
     * @return PostUser
     */
    public function addLike(\Home\FavorisBundle\Entity\PostUserLike $like)
    {
        $this->likes[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \Home\FavorisBundle\Entity\PostUserLike $like
     */
    public function removeLike(\Home\FavorisBundle\Entity\PostUserLike $like)
    {
        $this->likes->removeElement($like);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return PostUser
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }
    abstract public function getClassType();
}
