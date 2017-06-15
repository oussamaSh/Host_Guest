<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avishost
 *
 * @ORM\Table(name="avishost", indexes={@ORM\Index(name="Id_membre", columns={"Id_membre"})})
 * @ORM\Entity(repositoryClass="Home\AvisBundle\Repository\AvisHostRepository")
 */
class Avishost
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_host", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHost;

    /**
     * @var integer
     *
     * @ORM\Column(name="Acceuil_host", type="integer", nullable=false)
     */
    private $acceuilHost;

    /**
     * @var integer
     *
     * @ORM\Column(name="Reactivite_host", type="integer", nullable=false)
     */
    private $reactiviteHost;

    /**
     * @var string
     *
     * @ORM\Column(name="description_avis", type="text", length=65535, nullable=false)
     */
    private $descriptionAvis;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Home\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="idGuest", referencedColumnName="id", nullable=true)
     * })
     */

    private $idGuest;

    /**
     * @return int
     */




    /**
     * @var integer
     *
     * @ORM\Column(name="Signalement", type="integer", nullable=false)
     */
    private $signalement;


    public function getIdHost()
    {
        return $this->idHost;
    }

    /**
     * @param int $idHost
     */
    public function setIdHost($idHost)
    {
        $this->idHost = $idHost;
    }

    /**
     * @return int
     */
    public function getAcceuilHost()
    {
        return $this->acceuilHost;
    }

    /**
     * @param int $acceuilHost
     */
    public function setAcceuilHost($acceuilHost)
    {
        $this->acceuilHost = $acceuilHost;
    }

    /**
     * @return int
     */
    public function getReactiviteHost()
    {
        return $this->reactiviteHost;
    }

    /**
     * @param int $reactiviteHost
     */
    public function setReactiviteHost($reactiviteHost)
    {
        $this->reactiviteHost = $reactiviteHost;
    }

    /**
     * @return string
     */
    public function getDescriptionAvis()
    {
        return $this->descriptionAvis;
    }

    /**
     * @param string $descriptionAvis
     */
    public function setDescriptionAvis($descriptionAvis)
    {
        $this->descriptionAvis = $descriptionAvis;
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

    /**
     * @return int
     */
    public function getSignalement()
    {
        return $this->signalement;
    }

    /**
     * @param int $signalement
     */
    public function setSignalement($signalement)
    {
        $this->signalement = $signalement;
    }

    /**
     * @return \User
     */
    public function getIdGuest()
    {
        return $this->idGuest;
    }

    /**
     * @param \User $idGuest
     */
    public function setIdGuest($idGuest)
    {
        $this->idGuest = $idGuest;
    }





}

