<?php

namespace Home\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=30, nullable=true)
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=30, nullable=true)
     */
    protected $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Sexe", type="string", length=30, nullable=true)
     */
    protected $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse_physique", type="string", length=50, nullable=true)
     */
    protected $adressePhysique;

    /**
     * @var integer
     *
     * @ORM\Column(name="Code_postal", type="integer", nullable=true)
     */
    protected $codePostal;

    /**
     * @var integer
     *
     * @ORM\Column(name="Num_tel", type="integer", nullable=true)
     */
    protected $numTel;

    /**
     * @var integer
     *
     * @ORM\Column(name="Points_fidelite", type="integer", nullable=true)
     */
    protected $pointsFidelite;

    /**
     * @var integer
     *
     * @ORM\Column(name="Points_experience", type="integer", nullable=true)
     */
    protected $pointsExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="Niveau_experience", type="string", length=30, nullable=true)
     */
    protected $niveauExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="Piece_identité", type="blob", length=65535, nullable=true)
     */
    protected $pieceIdentite;

    /**
     * @var string
     *
     * @ORM\Column(name="Photo", type="blob", nullable=true)
     */
    protected $photo;


    /**
     * @var float
     *
     * @ORM\Column(name="Solde", type="float", precision=10, scale=0, nullable=true)
     */
    protected $solde;

    /**
     * @var string
     *
     * @ORM\Column(name="date_naissance", type="string", length=40, nullable=true)
     */
    protected $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_membre", type="string", length=30, nullable=true)
     */
    protected $etatMembre;

    /**
     * @var string
     *
     * @ORM\Column(name="code_inscription", type="string", length=30, nullable=true)
     */
    protected $codeInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=50, nullable=true)
     */
    protected $avatar;

    /**
     * One user has Many Posts.
     * @OneToMany(targetEntity="Home\FavorisBundle\Entity\PostUser", mappedBy="user")
     */
    protected $posts;
    /**
     * One user has Many followers.
     * @OneToMany(targetEntity="Home\EntityBundle\Entity\Favoris", mappedBy="idMembreFavori")
     */
    protected $followers;

    /**
     * One user has Many following.
     * @OneToMany(targetEntity="Home\EntityBundle\Entity\Favoris", mappedBy="idMembre")
     */
    protected $followings;

    /**
     * One user has Many following.
     * @OneToMany(targetEntity="Home\FavorisBundle\Entity\PostUserLike", mappedBy="user")
     */
    protected $likes;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getAdressePhysique()
    {
        return $this->adressePhysique;
    }

    /**
     * @param string $adressePhysique
     */
    public function setAdressePhysique($adressePhysique)
    {
        $this->adressePhysique = $adressePhysique;
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
     * @return int
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @param int $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }

    /**
     * @return int
     */
    public function getPointsFidelite()
    {
        return $this->pointsFidelite;
    }

    /**
     * @param int $pointsFidelite
     */
    public function setPointsFidelite($pointsFidelite)
    {
        $this->pointsFidelite = $pointsFidelite;
    }

    /**
     * @return int
     */
    public function getPointsExperience()
    {
        return $this->pointsExperience;
    }

    /**
     * @param int $pointsExperience
     */
    public function setPointsExperience($pointsExperience)
    {
        $this->pointsExperience = $pointsExperience;
    }

    /**
     * @return string
     */
    public function getNiveauExperience()
    {
        return $this->niveauExperience;
    }

    /**
     * @param string $niveauExperience
     */
    public function setNiveauExperience($niveauExperience)
    {
        $this->niveauExperience = $niveauExperience;
    }

    /**
     * @return string
     */
    public function getPieceIdentite()
    {
        return $this->pieceIdentite;
    }

    /**
     * @param string $pieceIdentite
     */
    public function setPieceIdentite($pieceIdentite)
    {
        $this->pieceIdentite = $pieceIdentite;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }


    /**
     * @return float
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param float $solde
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;
    }

    /**
     * @return string
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param string $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getEtatMembre()
    {
        return $this->etatMembre;
    }

    /**
     * @param string $etatMembre
     */
    public function setEtatMembre($etatMembre)
    {
        $this->etatMembre = $etatMembre;
    }

    /**
     * @return string
     */
    public function getCodeInscription()
    {
        return $this->codeInscription;
    }

    /**
     * @param string $codeInscription
     */
    public function setCodeInscription($codeInscription)
    {
        $this->codeInscription = $codeInscription;
    }

    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_CLIENT');
        $this->posts = new ArrayCollection();
        $this->followers = new ArrayCollection();
        $this->followings = new ArrayCollection();
    }



    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add post
     *
     * @param \Home\FavorisBundle\Entity\PostUser $post
     *
     * @return User
     */
    public function addPost(\Home\FavorisBundle\Entity\PostUser $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \Home\FavorisBundle\Entity\PostUser $post
     */
    public function removePost(\Home\FavorisBundle\Entity\PostUser $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add follower
     *
     * @param \Home\EntityBundle\Entity\Favoris $follower
     *
     * @return User
     */
    public function addFollower(\Home\EntityBundle\Entity\Favoris $follower)
    {
        $this->followers[] = $follower;

        return $this;
    }

    /**
     * Remove follower
     *
     * @param \Home\EntityBundle\Entity\Favoris $follower
     */
    public function removeFollower(\Home\EntityBundle\Entity\Favoris $follower)
    {
        $this->followers->removeElement($follower);
    }

    /**
     * Get followers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * Add following
     *
     * @param \Home\EntityBundle\Entity\Favoris $following
     *
     * @return User
     */
    public function addFollowing(\Home\EntityBundle\Entity\Favoris $following)
    {
        $this->followings[] = $following;

        return $this;
    }

    /**
     * Remove following
     *
     * @param \Home\EntityBundle\Entity\Favoris $following
     */
    public function removeFollowing(\Home\EntityBundle\Entity\Favoris $following)
    {
        $this->followings->removeElement($following);
    }

    /**
     * Get followings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFollowings()
    {
        return $this->followings;
    }

    /**
     * Add like
     *
     * @param \Home\FavorisBundle\Entity\PostUserLike $like
     *
     * @return User
     */
    public function addLike(\Home\FavorisBundle\Entity\PostUserLike $like)
    {
        $this->likes[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \Home\FavorisBundle\Entity\PostUserLike $like
     */
    public function removeLike(\Home\FavorisBundle\Entity\PostUserLike $like)
    {
        $this->likes->removeElement($like);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }
}
