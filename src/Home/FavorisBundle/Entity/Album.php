<?php

namespace Home\FavorisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="Home\FavorisBundle\Repository\AlbumRepository")
 */
class Album extends PostUser
{

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity="Media", mappedBy="album")
     */
    private $medias;

    public function __construct()
    {
        $this->medias = new ArrayCollection();

    }

    public function getClassType(){
        return "Album";
    }
    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Album
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Add media
     *
     * @param \Home\FavorisBundle\Entity\PostUserLike $media
     *
     * @return Album
     */
    public function addMedia(\Home\FavorisBundle\Entity\PostUserLike $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param \Home\FavorisBundle\Entity\PostUserLike $media
     */
    public function removeMedia(\Home\FavorisBundle\Entity\PostUserLike $media)
    {
        $this->medias->removeElement($media);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }
}
