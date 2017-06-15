<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="Id_membre", columns={"Id_membre"})})
 * @ORM\Entity(repositoryClass="Home\ReclamationBundle\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_reclamation", type="date", nullable=false)
     */
    private $dateReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="Sujet_reclamation", type="string", length=30, nullable=false)
     */
    private $sujetReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=30, nullable=false)
     */
    private $etat;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Home\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="Id_membre", referencedColumnName="id")
     * })
     */
    private $idMembre;

    /**
     * @return int
     */
    public function getIdReclamation()
    {
        return $this->idReclamation;
    }

    /**
     * @return \DateTime
     */
    public function getDateReclamation()
    {
        return $this->dateReclamation;
    }

    /**
     * @param \DateTime $dateReclamation
     */
    public function setDateReclamation($dateReclamation)
    {
        $this->dateReclamation = $dateReclamation;
    }

    /**
     * @return string
     */
    public function getSujetReclamation()
    {
        return $this->sujetReclamation;
    }

    /**
     * @param string $sujetReclamation
     */
    public function setSujetReclamation($sujetReclamation)
    {
        $this->sujetReclamation = $sujetReclamation;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
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

