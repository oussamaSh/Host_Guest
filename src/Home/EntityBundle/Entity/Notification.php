<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="Id_membre", columns={"Id_membre"})})
 * @ORM\Entity(repositoryClass="Home\NotificationBundle\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_notification", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNotification;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_notification", type="string", length=30, nullable=false)
     */
    private $typeNotification;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu_notification", type="string", length=250, nullable=false)
     */
    private $contenuNotification;

    /**
     * @var integer
     *
     * @ORM\Column(name="lu", type="integer", nullable=false)
     */
    private $lu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_notification", type="datetime", nullable=false)
     */
    private $dateNotification;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Home\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_membre", referencedColumnName="id")
     * })
     */
    private $idMembre;

    /**
     * @return int
     */
    public function getIdNotification()
    {
        return $this->idNotification;
    }

    /**
     * @return string
     */
    public function getTypeNotification()
    {
        return $this->typeNotification;
    }

    /**
     * @param string $typeNotification
     */
    public function setTypeNotification($typeNotification)
    {
        $this->typeNotification = $typeNotification;
    }

    /**
     * @return string
     */
    public function getContenuNotification()
    {
        return $this->contenuNotification;
    }

    /**
     * @param string $contenuNotification
     */
    public function setContenuNotification($contenuNotification)
    {
        $this->contenuNotification = $contenuNotification;
    }

    /**
     * @return int
     */
    public function getLu()
    {
        return $this->lu;
    }

    /**
     * @param int $lu
     */
    public function setLu($lu)
    {
        $this->lu = $lu;
    }

    /**
     * @return \DateTime
     */
    public function getDateNotification()
    {
        return $this->dateNotification;
    }

    /**
     * @param \DateTime $dateNotification
     */
    public function setDateNotification($dateNotification)
    {
        $this->dateNotification = $dateNotification;
    }

    /**
     * @return \User
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * @param \User $idMembre
     */
    public function setIdMembre($idMembre)
    {
        $this->idMembre = $idMembre;
    }


}

