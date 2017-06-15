<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateAchat
 *
 * @ORM\Table(name="date_achat", indexes={@ORM\Index(name="Id_produit", columns={"Id_produit"}), @ORM\Index(name="Id_membre", columns={"Id_membre"})})
 * @ORM\Entity(repositoryClass="Home\BoutiqueBundle\Repository\ProduitRepository")
 */
class DateAchat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_date_achat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDateAchat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_A", type="date", nullable=false)
     */
    private $dateA;

    /**
     * @var integer
     *
     * @ORM\Column(name="Quantite_produit", type="integer", nullable=false)
     */
    private $quantiteProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixTotal;

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
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_produit", referencedColumnName="Id_produit", onDelete="CASCADE")
     * })
     */
    private $idProduit;

    /**
     * @return int
     */
    public function getIdDateAchat()
    {
        return $this->idDateAchat;
    }

    /**
     * @param int $idDateAchat
     */
    public function setIdDateAchat($idDateAchat)
    {
        $this->idDateAchat = $idDateAchat;
    }

    /**
     * @return \DateTime
     */
    public function getDateA()
    {
        return $this->dateA;
    }

    /**
     * @param \DateTime $dateA
     */
    public function setDateA($dateA)
    {
        $this->dateA = $dateA;
    }

    /**
     * @return int
     */
    public function getQuantiteProduit()
    {
        return $this->quantiteProduit;
    }

    /**
     * @param int $quantiteProduit
     */
    public function setQuantiteProduit($quantiteProduit)
    {
        $this->quantiteProduit = $quantiteProduit;
    }

    /**
     * @return float
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * @param float $prixTotal
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;
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
     * @return \Produit
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param \Produit $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }




}

