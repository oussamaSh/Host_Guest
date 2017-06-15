<?php

namespace Home\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailAnnonce
 *
 * @ORM\Table(name="mail_annonce")
 * @ORM\Entity(repositoryClass="Home\EntityBundle\Repository\MailAnnonceRepository")
 */
class MailAnnonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAdmin", type="string", length=255)
     */
    private $emailAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set emailAdmin
     *
     * @param string $emailAdmin
     *
     * @return MailAnnonce
     */
    public function setEmailAdmin($emailAdmin)
    {
        $this->emailAdmin = $emailAdmin;

        return $this;
    }

    /**
     * Get emailAdmin
     *
     * @return string
     */
    public function getEmailAdmin()
    {
        return $this->emailAdmin;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return MailAnnonce
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}

