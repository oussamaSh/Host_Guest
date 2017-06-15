<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\validator\Constraints as Assert;

/**
 * Livraison
 *
 * @ORM\Entity(repositoryClass="Home\BoutiqueBundle\Repository\ProduitRepository")
 */
class Livraison
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_livraison", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse_destination", type="string", length=50, nullable=false)
     */
    private $adresseDestination;

    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=30, nullable=false)
     */
    private $region;

    /**
     * @var integer
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=false)
     */
    private $codePostal;

    /**
     * @var \DateTime
     * @Assert\GreaterThan("today")
     *
     * @ORM\Column(name="Date_livraison", type="date", nullable=false)
     */
    private $dateLivraison;

    /**
     * @var \DateAchat
     *
     * @ORM\ManyToOne(targetEntity="DateAchat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_DateAchat", referencedColumnName="Id_date_achat",onDelete="CASCADE")
     * })
     */
    private $id_DateAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat_livraison", type="string", length=30, nullable=false)
     */
    private $Etat_livraison;

    /**
     * @return int
     */
    public function getIdLivraison()
    {
        return $this->idLivraison;
    }

    /**
     * @param int $idLivraison
     */
    public function setIdLivraison($idLivraison)
    {
        $this->idLivraison = $idLivraison;
    }

    /**
     * @return string
     */
    public function getAdresseDestination()
    {
        return $this->adresseDestination;
    }

    /**
     * @param string $adresseDestination
     */
    public function setAdresseDestination($adresseDestination)
    {
        $this->adresseDestination = $adresseDestination;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param int $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return \DateTime
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }

    /**
     * @param \DateTime $dateLivraison
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;
    }

    /**
     * @return string
     */
    public function getEtatLivraison()
    {
        return $this->Etat_livraison;
    }

    /**
     * @param string $Etat_livraison
     */
    public function setEtatLivraison($Etat_livraison)
    {
        $this->Etat_livraison = $Etat_livraison;
    }

    /**
     * @return \DateAchat
     */
    public function getIdDateAchat()
    {
        return $this->id_DateAchat;
    }

    /**
     * @param \DateAchat $id_DateAchat
     */
    public function setIdDateAchat($id_DateAchat)
    {
        $this->id_DateAchat = $id_DateAchat;
    }





}

