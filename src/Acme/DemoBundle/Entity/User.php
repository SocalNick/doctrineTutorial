<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $password;
    
    /**
     * @ORM\OneToMany(targetEntity="Acme\DemoBundle\Entity\Address", mappedBy="user")
     */
    private $addresses;

    
    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }
    
    public function addAddress(Address $a)
    {
        $this->addresses[] = $a;
    }
    
    public function setName($name)
    {
        $this->name = (string) $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getAddresses()
    {
        return $this->addresses;
    }
}
