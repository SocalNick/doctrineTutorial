<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Acme\DemoBundle\Entity\User", inversedBy="addresses")
     */
    private $user;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $street1;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    public function __construct(User $user, $street1)
    {
        $this->user = $user;
        $this->street1 = $street1;
    }
    
    public function __toString()
    {
        return (string) $this->street1;
    }
    
    /**
     * @ORM\prePersist()
     */
    public function setCreationDate()
    {
        $this->created = new \DateTime();
    }
}
