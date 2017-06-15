<?php

namespace Home\FavorisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostUserLike
 *
 * @ORM\Table(name="post_user_like")
 * @ORM\Entity(repositoryClass="Home\FavorisBundle\Repository\PostUserLikeRepository")
 */
class PostUserLike
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    private $dateAjout;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Home\UserBundle\Entity\User",inversedBy="likes")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="Id_user", referencedColumnName="id")
     * })
     */
    private $user;
    public function getClassType(){
        return $this->get_class();
    }
    /**
     * @ORM\ManyToOne(targetEntity="PostUser", inversedBy="likes")
     * @ORM\JoinColumn(name="post_user_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $postUser;

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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return PostUserLike
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

    /**
     * Set user
     *
     * @param \Home\UserBundle\Entity\User $user
     *
     * @return PostUserLike
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
     * Set postUser
     *
     * @param \Home\FavorisBundle\Entity\PostUser $postUser
     *
     * @return PostUserLike
     */
    public function setPostUser(\Home\FavorisBundle\Entity\PostUser $postUser = null)
    {
        $this->postUser = $postUser;

        return $this;
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
