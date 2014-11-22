<?php

namespace Eliastre100\PythonProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tps
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Eliastre100\PythonProjectBundle\Entity\TpsRepository")
 */
class Tps
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Eliastre100\UserBundle\Entity\User")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Eliastre100\GroupsBundle\Entity\Groups")
     */
    private $groupe;

    /**
     * @var string
     *
     * @ORM\Column(name="visibility", type="string", length=255)
     */
    private $visibility;


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
     * Set name
     *
     * @param string $name
     * @return Tps
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set owner
     *
     * @param string $owner
     * @return Tps
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set groupe
     *
     * @param string $groupe
     * @return Tps
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return string 
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set visibility
     *
     * @param string $visibility
     * @return Tps
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return string 
     */
    public function getVisibility()
    {
        return $this->visibility;
    }
}
