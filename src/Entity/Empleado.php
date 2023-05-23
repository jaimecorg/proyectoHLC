<?php

namespace App\Entity;

use App\Repository\EmpleadoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=EmpleadoRepository::class)
 */
class Empleado implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $clave;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $permisos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $administrador;

    /**
     * @ORM\Column(type="boolean")
     */
    private $moderador;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    public function getPermisos(): ?string
    {
        return $this->permisos;
    }

    public function setPermisos(string $permisos): self
    {
        $this->permisos = $permisos;

        return $this;
    }

    public function getAdministrador()
    {
        return $this->administrador;
    }

    public function setAdministrador($administrador)
    {
        $this->administrador = $administrador;
        return $this;
    }

    public function getModerador()
    {
        return $this->moderador;
    }

    public function setModerador($moderador)
    {
        $this->moderador = $moderador;
        return $this;
    }

    public function getRoles()
    {
        $roles = ['ROLE_USUARIO'];

        if ($this->getAdministrador()) {
            $roles[] = 'ROLE_ADMIN';
        }

        if ($this->getModerador()) {
            $roles[] = 'ROLE_MODERADOR';
        }

        return $roles;
    }

    public function getPassword()
    {
        return $this->clave;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getUsuario();
    }

    public function eraseCredentials()
    {
    }
}
