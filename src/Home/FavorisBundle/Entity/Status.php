<?php

namespace Home\FavorisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Home\FavorisBundle\Entity\PostUser;
/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity(repositoryClass="Home\FavorisBundle\Repository\StatusRepository")
 */
class Status extends PostUser
{

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * Get classtype
     *
     * @return string
     */
    public function getClassType(){
        return "Status";
    }
    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Status
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }



    public function __toString()
    {
        return $this->contenu;
    }

}
