<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", uniqueConstraints={@ORM\UniqueConstraint(name="Id_paiment", columns={"Id_paiment"})}, indexes={@ORM\Index(name="Id_reservation", columns={"Id_reservation"}), @ORM\Index(name="Id_membre", columns={"Id_membre"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_facture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFacture;

    /**
     * @var float
     *
     * @ORM\Column(name="Montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_facture", type="datetime", nullable=false)
     */
    private $dateFacture = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=30, nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=30, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Id_paiment", type="string", length=20, nullable=false)
     */
    private $idPaiment;

    /**
     * @var \Reservation
     *
     * @ORM\ManyToOne(targetEntity="Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_reservation", referencedColumnName="Id_reservation")
     * })
     */
    private $idReservation;

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
     * Get idFacture
     *
     * @return integer
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Facture
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set dateFacture
     *
     * @param \DateTime $dateFacture
     *
     * @return Facture
     */
    public function setDateFacture($dateFacture)
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    /**
     * Get dateFacture
     *
     * @return \DateTime
     */
    public function getDateFacture()
    {
        return $this->dateFacture;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Facture
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Facture
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set idPaiment
     *
     * @param string $idPaiment
     *
     * @return Facture
     */
    public function setIdPaiment($idPaiment)
    {
        $this->idPaiment = $idPaiment;

        return $this;
    }

    /**
     * Get idPaiment
     *
     * @return string
     */
    public function getIdPaiment()
    {
        return $this->idPaiment;
    }

    /**
     * Set idReservation
     *
     * @param \Home\EntityBundle\Entity\Reservation $idReservation
     *
     * @return Facture
     */
    public function setIdReservation(\Home\EntityBundle\Entity\Reservation $idReservation = null)
    {
        $this->idReservation = $idReservation;

        return $this;
    }

    /**
     * Get idReservation
     *
     * @return \Home\EntityBundle\Entity\Reservation
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * Set idMembre
     *
     * @param \Home\UserBundle\Entity\User $idMembre
     *
     * @return Facture
     */
    public function setIdMembre(\Home\UserBundle\Entity\User $idMembre = null)
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    /**
     * Get idMembre
     *
     * @return \Home\UserBundle\Entity\User
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }
}
