<?php
// src/Acme/UserBundle/Entity/User.php

namespace Eliastre100\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Eliastre100\GroupsBundle\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add groupes
     *
     * @param \Eliastre100\GroupsBundle\Entity\Groups $groupes
     * @return User
     */
    public function addGroupe(\Eliastre100\GroupsBundle\Entity\Groups $groupes)
    {
        $this->groupes[] = $groupes;

        return $this;
    }

    /**
     * Remove groupes
     *
     * @param \Eliastre100\GroupsBundle\Entity\Groups $groupes
     */
    public function removeGroupe(\Eliastre100\GroupsBundle\Entity\Groups $groupes)
    {
        $this->groupes->removeElement($groupes);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupes()
    {
        return $this->getGroupes;
    }
}
