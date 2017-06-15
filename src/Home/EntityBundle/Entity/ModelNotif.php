<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModelNotif
 *
 * @ORM\Table(name="model_notif")
 * @ORM\Entity(repositoryClass="Home\NotificationBundle\Repository\NotificationRepository")
 */
class ModelNotif
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_model_notif", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idModelNotif;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_notif", type="string", length=30, nullable=false)
     */
    private $typeNotif;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu_notif", type="string", length=255, nullable=false)
     */
    private $contenuNotif;

    /**
     * @return int
     */
    public function getIdModelNotif()
    {
        return $this->idModelNotif;
    }

    /**
     * @return string
     */
    public function getTypeNotif()
    {
        return $this->typeNotif;
    }

    /**
     * @param string $typeNotif
     */
    public function setTypeNotif($typeNotif)
    {
        $this->typeNotif = $typeNotif;
    }

    /**
     * @return string
     */
    public function getContenuNotif()
    {
        return $this->contenuNotif;
    }

    /**
     * @param string $contenuNotif
     */
    public function setContenuNotif($contenuNotif)
    {
        $this->contenuNotif = $contenuNotif;
    }


}

