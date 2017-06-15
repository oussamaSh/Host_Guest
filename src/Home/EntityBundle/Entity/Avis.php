<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Home\UserBundle\Entity\User;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="Id_logement", columns={"Id_logement"}), @ORM\Index(name="Id_membre", columns={"Id_membre"})})
 * @ORM\Entity(repositoryClass="Home\AvisBundle\Repository\AvisRepository")
 */

class Avis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_avis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAvis;

    /**
     * @var integer
     *
     * @ORM\Column(name="Note_avis", type="integer", nullable=false)
     */
    private $noteAvis;

    /**
     * @var string
     *
     * @ORM\Column(name="Description_avis", type="string", length=250, nullable=false)
     */
    private $descriptionAvis;



    /**
     * @var integer
     *
     * @ORM\Column(name="Proprete", type="integer", nullable=false)
     */
    private $proprete;

    /**
     * @var integer
     *
     * @ORM\Column(name="Quaite_prix", type="integer", nullable=false)
     */
    private $quaitePrix;

    /**
     * @var integer
     *
     * @ORM\Column(name="Accueil", type="integer", nullable=false)
     */
    private $accueil;

    /**
     * @var integer
     *
     * @ORM\Column(name="Signalement", type="integer", nullable=false)
     */
    private $signalement;

    /**
     * @var \Logement
     *
     * @ORM\ManyToOne(targetEntity="Logement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_logement", referencedColumnName="Id_logement")
     * })
     */
    private $idLogement;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Home\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_membre", referencedColumnName="id")
     * })
     */
    private $id_user;

    /**
     * @return int
     */
    public function getIdAvis()
    {
        return $this->idAvis;
    }

    /**
     * @param int $idAvis
     */
    public function setIdAvis($idAvis)
    {
        $this->idAvis = $idAvis;
    }

    /**
     * @return int
     */
    public function getNoteAvis()
    {
        return $this->noteAvis;
    }

    /**
     * @param int $noteAvis
     */
    public function setNoteAvis($noteAvis)
    {
        $this->noteAvis = $noteAvis;
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
     * @return int
     */
    public function getProprete()
    {
        return $this->proprete;
    }

    /**
     * @param int $proprete
     */
    public function setProprete($proprete)
    {
        $this->proprete = $proprete;
    }

    /**
     * @return int
     */
    public function getQuaitePrix()
    {
        return $this->quaitePrix;
    }

    /**
     * @param int $quaitePrix
     */
    public function setQuaitePrix($quaitePrix)
    {
        $this->quaitePrix = $quaitePrix;
    }

    /**
     * @return int
     */
    public function getAccueil()
    {
        return $this->accueil;
    }

    /**
     * @param int $accueil
     */
    public function setAccueil($accueil)
    {
        $this->accueil = $accueil;
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
     * @return \Logement
     */
    public function getIdLogement()
    {
        return $this->idLogement;
    }

    /**
     * @param \Logement $idLogement
     */
    public function setIdLogement($idLogement)
    {
        $this->idLogement = $idLogement;
    }

    /**
     * @return \User
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param \User $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }






}

