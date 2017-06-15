<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favoris
 *
 * @ORM\Table(name="favoris", indexes={@ORM\Index(name="Id_membre", columns={"Id_membre_favori"}), @ORM\Index(name="Id_membre_2", columns={"Id_membre"})})
 * @ORM\Entity
 */
class Favoris
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_favoris", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFavoris;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Home\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_membre_favori", referencedColumnName="id")
     * })
     */
    private $idMembreFavori;

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
     * Get idFavoris
     *
     * @return integer
     */
    public function getIdFavoris()
    {
        return $this->idFavoris;
    }

    /**
     * Set idMembreFavori
     *
     * @param \Home\UserBundle\Entity\User $idMembreFavori
     *
     * @return Favoris
     */
    public function setIdMembreFavori(\Home\UserBundle\Entity\User $idMembreFavori = null)
    {
        $this->idMembreFavori = $idMembreFavori;

        return $this;
    }

    /**
     * Get idMembreFavori
     *
     * @return \Home\UserBundle\Entity\User
     */
    public function getIdMembreFavori()
    {
        return $this->idMembreFavori;
    }

    /**
     * Set idMembre
     *
     * @param \Home\UserBundle\Entity\User $idMembre
     *
     * @return Favoris
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
