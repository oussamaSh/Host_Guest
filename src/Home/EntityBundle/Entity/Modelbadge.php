<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\validator\Constraints as Assert;

/**
 * Modelbadge
 *
 * @ORM\Table(name="modelbadge")
 * @ORM\Entity(repositoryClass="Home\BadgeBundle\Repository\BadgeRepository")
 * @ORM\Entity(repositoryClass="Home\BadgeBundle\Repository\BadgeAffecterRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Modelbadge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_modelBadge", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idModelbadge;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=30, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description_badge", type="string", length=30, nullable=false)
     */
    private $descriptionBadge;



    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    public $path;

    public $file;

    /**
     * @var \DateTime
     *
     * @ORM\COlumn(name="updated_at",type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->updateAt = new \DateTime();
    }

    public function getIdModelbadge()
    {
        return $this->idModelbadge;
    }

    /**
     * @param int $idModelbadge
     */
    public function setIdModelbadge($idModelbadge)
    {
        $this->idModelbadge = $idModelbadge;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescriptionBadge()
    {
        return $this->descriptionBadge;
    }

    /**
     * @param string $descriptionBadge
     */
    public function setDescriptionBadge($descriptionBadge)
    {
        $this->descriptionBadge = $descriptionBadge;
    }



    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/uploads';
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getAssetPath()
    {
        return 'uploads/'.$this->path;
    }

    /**
     * @ORM\Prepersist()
     * @ORM\Preupdate()
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt = new \DateTime();

        if (null !== $this->file)
            $this->path = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->path);
            unset($this->file);

            if ($this->oldFile != null) unlink($this->tempFile);
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFile)) unlink($this->tempFile);
    }





    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }













}

