<?php

namespace Home\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinColumns;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * Logement
 *
 * @ORM\Table(name="logement", indexes={@ORM\Index(name="Id_membre", columns={"Id_membre"})})
 * @ORM\Entity(repositoryClass="Home\AnnonceBundle\Repository\LogementRepository")
 */

class Logement
{

    /**
     * @var integer
     *
     * @ORM\Column(name="Id_logement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLogement;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre_annonce", type="string", length=200, nullable=false)
     */
    private $titreAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="Pays_logement", type="string", length=30, nullable=true)
     */
    private $paysLogement;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse_logement", type="string", length=50, nullable=true)
     */
    private $adresseLogement;

    /**
     * @var string
     *
     * @ORM\Column(name="Description_logement", type="text", length=65535, nullable=true)
     */
    private $descriptionLogement;

    /**
     * @var integer
     *
     * @ORM\Column(name="Code_postal", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix_logement", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixLogement;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nbr_chambre", type="integer", nullable=true)
     */
    private $nbrChambre;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nbr_lit", type="integer", nullable=true)
     */
    private $nbrLit;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nbr_salledebain", type="integer", nullable=true)
     */
    private $nbrSalledebain;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_logement", type="string", length=30, nullable=true)
     */
    private $typeLogement;

    /**
     * @var string
     *
     * @ORM\Column(name="Parking", type="string", length=30, nullable=true)
     */
    private $parking;

    /**
     * @var string
     *
     * @ORM\Column(name="CheckIn", type="string", length=30, nullable=true)
     */
    private $checkin;

    /**
     * @var string
     *
     * @ORM\Column(name="CheckOut", type="string", length=30, nullable=true)
     */
    private $checkout;

    /**
     * @var string
     *
     * @ORM\Column(name="Reglement_logement", type="text", length=65535, nullable=true)
     */
    private $reglementLogement;

    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=30, nullable=true)
     */
    private $region;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reservation_express", type="boolean", nullable=true)
     */
    private $reservationExpress;

    /**
     * @var integer
     *
     * @ORM\Column(name="Signalement_annonce", type="integer", nullable=true)
     */
    private $signalementAnnonce;

    /**
     * @var float
     *
     * @ORM\Column(name="LatLogement", type="float", precision=10, scale=0, nullable=true)
     */
    private $latlogement;

    /**
     * @var float
     *
     * @ORM\Column(name="LongLogement", type="float", precision=10, scale=0, nullable=true)
     */
    private $longlogement;

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
     * @ORM\OneToMany(targetEntity="Image", mappedBy="idLogement", cascade={"persist", "remove"})
     */
    public $pictures;


    /**
     * @ManyToMany(targetEntity="Equipement")
     * @JoinTable(name="annonce_association",
     *      joinColumns={@JoinColumn(name="Id_logement", referencedColumnName="Id_logement")},
     *      inverseJoinColumns={@JoinColumn(name="Id_equipement", referencedColumnName="Id_equipement", unique=false)}
     *      )
     */
    public $equipements;


    /**
     * @return int
     */
    public function getIdLogement()
    {
        return $this->idLogement;
    }

    /**
     * @param int $idLogement
     */
    public function setIdLogement($idLogement)
    {
        $this->idLogement = $idLogement;
    }

    /**
     * @return string
     */
    public function getTitreAnnonce()
    {
        return $this->titreAnnonce;
    }

    /**
     * @param string $titreAnnonce
     */
    public function setTitreAnnonce($titreAnnonce)
    {
        $this->titreAnnonce = $titreAnnonce;
    }

    /**
     * @return string
     */
    public function getPaysLogement()
    {
        return $this->paysLogement;
    }

    /**
     * @param string $paysLogement
     */
    public function setPaysLogement($paysLogement)
    {
        $this->paysLogement = $paysLogement;
    }

    /**
     * @return string
     */
    public function getAdresseLogement()
    {
        return $this->adresseLogement;
    }

    /**
     * @param string $adresseLogement
     */
    public function setAdresseLogement($adresseLogement)
    {
        $this->adresseLogement = $adresseLogement;
    }

    /**
     * @return string
     */
    public function getDescriptionLogement()
    {
        return $this->descriptionLogement;
    }

    /**
     * @param string $descriptionLogement
     */
    public function setDescriptionLogement($descriptionLogement)
    {
        $this->descriptionLogement = $descriptionLogement;
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
     * @return float
     */
    public function getPrixLogement()
    {
        return $this->prixLogement;
    }

    /**
     * @param float $prixLogement
     */
    public function setPrixLogement($prixLogement)
    {
        $this->prixLogement = $prixLogement;
    }

    /**
     * @return int
     */
    public function getNbrChambre()
    {
        return $this->nbrChambre;
    }

    /**
     * @param int $nbrChambre
     */
    public function setNbrChambre($nbrChambre)
    {
        $this->nbrChambre = $nbrChambre;
    }

    /**
     * @return int
     */
    public function getNbrLit()
    {
        return $this->nbrLit;
    }

    /**
     * @param int $nbrLit
     */
    public function setNbrLit($nbrLit)
    {
        $this->nbrLit = $nbrLit;
    }

    /**
     * @return int
     */
    public function getNbrSalledebain()
    {
        return $this->nbrSalledebain;
    }

    /**
     * @param int $nbrSalledebain
     */
    public function setNbrSalledebain($nbrSalledebain)
    {
        $this->nbrSalledebain = $nbrSalledebain;
    }

    /**
     * @return string
     */
    public function getTypeLogement()
    {
        return $this->typeLogement;
    }

    /**
     * @param string $typeLogement
     */
    public function setTypeLogement($typeLogement)
    {
        $this->typeLogement = $typeLogement;
    }

    /**
     * @return string
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * @param string $parking
     */
    public function setParking($parking)
    {
        $this->parking = $parking;
    }

    /**
     * @return string
     */
    public function getCheckin()
    {
        return $this->checkin;
    }

    /**
     * @param string $checkin
     */
    public function setCheckin($checkin)
    {
        $this->checkin = $checkin;
    }

    /**
     * @return string
     */
    public function getCheckout()
    {
        return $this->checkout;
    }

    /**
     * @param string $checkout
     */
    public function setCheckout($checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * @return string
     */
    public function getReglementLogement()
    {
        return $this->reglementLogement;
    }

    /**
     * @param string $reglementLogement
     */
    public function setReglementLogement($reglementLogement)
    {
        $this->reglementLogement = $reglementLogement;
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
     * @return boolean
     */
    public function isReservationExpress()
    {
        return $this->reservationExpress;
    }

    /**
     * @param boolean $reservationExpress
     */
    public function setReservationExpress($reservationExpress)
    {
        $this->reservationExpress = $reservationExpress;
    }

    /**
     * @return int
     */
    public function getSignalementAnnonce()
    {
        return $this->signalementAnnonce;
    }

    /**
     * @param int $signalementAnnonce
     */
    public function setSignalementAnnonce($signalementAnnonce)
    {
        $this->signalementAnnonce = $signalementAnnonce;
    }

    /**
     * @return float
     */
    public function getLatlogement()
    {
        return $this->latlogement;
    }

    /**
     * @param float $latlogement
     */
    public function setLatlogement($latlogement)
    {
        $this->latlogement = $latlogement;
    }

    /**
     * @return float
     */
    public function getLonglogement()
    {
        return $this->longlogement;
    }

    /**
     * @param float $longlogement
     */
    public function setLonglogement($longlogement)
    {
        $this->longlogement = $longlogement;
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
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }



    /**
     * Get reservationExpress
     *
     * @return boolean
     */
    public function getReservationExpress()
    {
        return $this->reservationExpress;
    }

    /**
     * Add picture
     *
     * @param \Home\EntityBundle\Entity\Image $picture
     *
     * @return Logement
     */
    public function addPicture(\Home\EntityBundle\Entity\Image $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \Home\EntityBundle\Entity\Image $picture
     */
    public function removePicture(\Home\EntityBundle\Entity\Image $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Add equipement
     *
     * @param \Home\EntityBundle\Entity\Equipement $equipement
     *
     * @return Logement
     */
    public function addEquipement(\Home\EntityBundle\Entity\Equipement $equipement)
    {
        $this->equipements[] = $equipement;

        return $this;
    }

    /**
     * Remove equipement
     *
     * @param \Home\EntityBundle\Entity\Equipement $equipement
     */
    public function removeEquipement(\Home\EntityBundle\Entity\Equipement $equipement)
    {
        $this->equipements->removeElement($equipement);
    }

    /**
     * Get equipements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipements()
    {
        return $this->equipements;
    }
}
