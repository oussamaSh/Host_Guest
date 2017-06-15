<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="Id_reclamation", columns={"Id_reclamation"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu_admin", type="string", length=250, nullable=false)
     */
    private $contenuAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu_membre", type="string", length=250, nullable=false)
     */
    private $contenuMembre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Time_msg", type="datetime", nullable=false)
     */
    private $timeMsg;

    /**
     * @var \Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_reclamation", referencedColumnName="Id_reclamation")
     * })
     */
    private $idReclamation;



    /**
     * Get idMessage
     *
     * @return integer
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * Set contenuAdmin
     *
     * @param string $contenuAdmin
     *
     * @return Message
     */
    public function setContenuAdmin($contenuAdmin)
    {
        $this->contenuAdmin = $contenuAdmin;

        return $this;
    }

    /**
     * Get contenuAdmin
     *
     * @return string
     */
    public function getContenuAdmin()
    {
        return $this->contenuAdmin;
    }

    /**
     * Set contenuMembre
     *
     * @param string $contenuMembre
     *
     * @return Message
     */
    public function setContenuMembre($contenuMembre)
    {
        $this->contenuMembre = $contenuMembre;

        return $this;
    }

    /**
     * Get contenuMembre
     *
     * @return string
     */
    public function getContenuMembre()
    {
        return $this->contenuMembre;
    }

    /**
     * Set timeMsg
     *
     * @param \DateTime $timeMsg
     *
     * @return Message
     */
    public function setTimeMsg($timeMsg)
    {
        $this->timeMsg = $timeMsg;

        return $this;
    }

    /**
     * Get timeMsg
     *
     * @return \DateTime
     */
    public function getTimeMsg()
    {
        return $this->timeMsg;
    }

    /**
     * Set idReclamation
     *
     * @param \Home\EntityBundle\Entity\Reclamation $idReclamation
     *
     * @return Message
     */
    public function setIdReclamation(\Home\EntityBundle\Entity\Reclamation $idReclamation = null)
    {
        $this->idReclamation = $idReclamation;

        return $this;
    }

    /**
     * Get idReclamation
     *
     * @return \Home\EntityBundle\Entity\Reclamation
     */
    public function getIdReclamation()
    {
        return $this->idReclamation;
    }
}
