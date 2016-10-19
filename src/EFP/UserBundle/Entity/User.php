<?php

namespace EFP\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="EFP\UserBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class User implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=50, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=20, unique=true)
     * @Assert\NotBlank()
     */
    private $dni;
    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=256)
     * @Assert\NotBlank()
     */
    private $direccion;
    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=256)
     * @Assert\NotBlank()
     */
    private $ciudad;
    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=256)
     * @Assert\NotBlank()
     */
    private $provincia;
    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=10)
     * @Assert\NotBlank()
     */
    private $cp;
    /**
     * @var string
     *
     * @ORM\Column(name="telfijo", type="string", length=20)
     * @Assert\NotBlank()
     */
    private $telfijo;
    /**
     * @var string
     *
     * @ORM\Column(name="telmovil", type="string", length=20)
     * @Assert\NotBlank()
     */
    private $telmovil;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="fech_nac", type="string", length=10)
     */
    private $fechnac;
     /**
     * @var string
     *
     * @ORM\Column(name="fech_ing", type="string", length=10)
     */
    private $feching;
     /**
     * @var string
     *
     * @ORM\Column(name="fech_reing", type="string", length=10)
     */
    private $fechreing;
    /**
     * @var string
     *
     * @ORM\Column(name="tipoalumno", type="string", columnDefinition="ENUM('CLASES_YOGA', 'INSTRUCTORADO','PROFESORADO','POSGRADO','CURSO_NATURISTA')", length=100)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"CLASES_YOGA", "INSTRUCTORADO","PROFESORADO","POSGRADO","CURSO_NATURISTA"})
     */
    private $tipoalumno;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
   private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", columnDefinition="ENUM('ROLE_ADMIN', 'ROLE_USER')", length=50)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"ROLE_ADMIN", "ROLE_USER"})
     */
    private $role;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return User
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }
    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return User
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }
    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return User
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }
    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }
    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }
    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return User
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }
    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return User
     */
    public function setcp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     *@param string cp
     * 
     * @return User
     */
    public function getcp()
    {
        return $this->cp;
    }
    /**
     * Set telfijo
     *
     * @param string telfijo
     *
     * @return User
     */
    public function settelfijo($telfijo)
    {
        $this->telfijo = $telfijo;

        return $this;
    }

    /**
     * Get telmovil
     *
     *@param string telmovil
     * 
     * @return User
     */
    public function gettelmovil()
    {
        return $this->telmovil;
    }
    /**
     * Set telmovil
     *
     * @param string telmovil
     *
     * @return User
     */
    public function settelmovil($telmovil)
    {
        $this->telmovil= $telmovil;

        return $this;
    }

    /**
     * Get telfijo
     *
     *@param string telfijo
     * 
     * @return User
     */
    public function gettelfijo()
    {
        return $this->telfijo;
    }
    /**
     * Set email
     *
     * @param string email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set fechnac
     *
     * @param date $fechnac
     *
     * @return User
     */
    public function setfechnac($fechnac)
    {
        $this->fechnac = $fechnac;

        return $this;
    }

    /**
     * Get fechnac
     *
     * @return date
     */
    public function getfechnac()
    {
        return $this->fechnac;
    }
    /**
     * Set feching
     *
     * @param date $feching
     *
     * @return User
     */
    public function setfeching($feching)
    {
        $this->feching = $feching;

        return $this;
    }

    /**
     * Get feching
     *
     * @return date
     */
    public function getfeching()
    {
        return $this->feching;
    }
    /**
     * Set fechreing
     *
     * @param date $fechreing
     *
     * @return User
     */
    public function setfechreing($fechreing)
    {
        $this->fechreing = $fechreing;

        return $this;
    }

    /**
     * Get fechreing
     *
     * @return date
     */
    public function getfechreing()
    {
        return $this->fechreing;
    }
    /**
     * Set tipoalumno
     *
     * @param string $tipoalumno
     *
     * @return User
     */
    public function settipoalumno($tipoalumno)
    {
        $this->tipoalumno = $tipoalumno;

        return $this;
    }

    /**
     * Get tipoalumno
     *
     * @return string
     */
    public function gettipoalumno()
    {
        return $this->tipoalumno;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }
    
    public function getRoles()
    {
        
    }
    
    public function getSalt()
    {
        
    }
    
    public function eraseCredentials()
    {
        
    }
}

