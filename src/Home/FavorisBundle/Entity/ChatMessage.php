<?php

namespace Home\FavorisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChatMessage
 *
 * @ORM\Table(name="chat_message")
 * @ORM\Entity(repositoryClass="Home\FavorisBundle\Repository\ChatMessageRepository")
 */
class ChatMessage
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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Home\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="Id_user", referencedColumnName="id")
     * })
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    protected $dateAjout;


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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return ChatMessage
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return ChatMessage
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
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjoutString()
    {
        return $this->dateAjout->format('d M Y');
    }
    /**
     * Set user
     *
     * @param \Home\UserBundle\Entity\User $user
     *
     * @return ChatMessage
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
}
