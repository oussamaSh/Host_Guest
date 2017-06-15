<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListeBadge
 *
 * @ORM\Table(name="liste_badge", indexes={@ORM\Index(name="Id_membre", columns={"Id_membre"}), @ORM\Index(name="Id_badge", columns={"Id_badge"})})
 * @ORM\Entity
 */
class ListeBadge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_list_badge", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idListBadge;

    /**
     * @var \Badge
     *
     * @ORM\ManyToOne(targetEntity="Badge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_badge", referencedColumnName="Id_badge")
     * })
     */
    private $idBadge;

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
     * Get idListBadge
     *
     * @return integer
     */
    public function getIdListBadge()
    {
        return $this->idListBadge;
    }

    /**
     * Set idBadge
     *
     * @param \Home\EntityBundle\Entity\Badge $idBadge
     *
     * @return ListeBadge
     */
    public function setIdBadge(\Home\EntityBundle\Entity\Badge $idBadge = null)
    {
        $this->idBadge = $idBadge;

        return $this;
    }

    /**
     * Get idBadge
     *
     * @return \Home\EntityBundle\Entity\Badge
     */
    public function getIdBadge()
    {
        return $this->idBadge;
    }

    /**
     * Set idMembre
     *
     * @param \Home\UserBundle\Entity\User $idMembre
     *
     * @return ListeBadge
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
