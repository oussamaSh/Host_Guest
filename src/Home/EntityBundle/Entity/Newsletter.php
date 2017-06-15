<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter", indexes={@ORM\Index(name="Id_membre", columns={"Id_membre"})})
 * @ORM\Entity
 */
class Newsletter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_newsletter", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNewsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre_newsletter", type="string", length=30, nullable=false)
     */
    private $titreNewsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="Sujet_newsletter", type="string", length=30, nullable=false)
     */
    private $sujetNewsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="Image_newsletter", type="blob", length=65535, nullable=false)
     */
    private $imageNewsletter;

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
     * Get idNewsletter
     *
     * @return integer
     */
    public function getIdNewsletter()
    {
        return $this->idNewsletter;
    }

    /**
     * Set titreNewsletter
     *
     * @param string $titreNewsletter
     *
     * @return Newsletter
     */
    public function setTitreNewsletter($titreNewsletter)
    {
        $this->titreNewsletter = $titreNewsletter;

        return $this;
    }

    /**
     * Get titreNewsletter
     *
     * @return string
     */
    public function getTitreNewsletter()
    {
        return $this->titreNewsletter;
    }

    /**
     * Set sujetNewsletter
     *
     * @param string $sujetNewsletter
     *
     * @return Newsletter
     */
    public function setSujetNewsletter($sujetNewsletter)
    {
        $this->sujetNewsletter = $sujetNewsletter;

        return $this;
    }

    /**
     * Get sujetNewsletter
     *
     * @return string
     */
    public function getSujetNewsletter()
    {
        return $this->sujetNewsletter;
    }

    /**
     * Set imageNewsletter
     *
     * @param string $imageNewsletter
     *
     * @return Newsletter
     */
    public function setImageNewsletter($imageNewsletter)
    {
        $this->imageNewsletter = $imageNewsletter;

        return $this;
    }

    /**
     * Get imageNewsletter
     *
     * @return string
     */
    public function getImageNewsletter()
    {
        return $this->imageNewsletter;
    }

    /**
     * Set idMembre
     *
     * @param \Home\UserBundle\Entity\User $idMembre
     *
     * @return Newsletter
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
