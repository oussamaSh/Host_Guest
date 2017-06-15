<?php

namespace Home\FavorisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="Home\FavorisBundle\Repository\MediaRepository")
 */
class Media extends PostUser
{

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @Assert\File(mimeTypes={ "image/jpeg" ,"video/mp4"})
     * @ORM\Column(name="File", type="string", length=255)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="medias")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     */
    private $album;

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Media
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
    public function getClassType(){
        return $this->get_class();
    }
    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Media
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set album
     *
     * @param \Home\FavorisBundle\Entity\Album $album
     *
     * @return Media
     */
    public function setAlbum(\Home\FavorisBundle\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \Home\FavorisBundle\Entity\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
