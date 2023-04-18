<?php

namespace App\Entity;

use App\Repository\MascotaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MascotaRepository::class)
 */
class Mascota
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $especie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raza;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @ORM\ManyToOne(targetEntity=Duenio::class, inversedBy="mascotas")
     */
    private $duenio;

    /**
     * @ORM\OneToMany(targetEntity=Cita::class, mappedBy="mascota")
     */
    private $citas;

    public function __construct()
    {
        $this->citas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEspecie(): ?string
    {
        return $this->especie;
    }

    public function setEspecie(?string $especie): self
    {
        $this->especie = $especie;

        return $this;
    }

    public function getRaza(): ?string
    {
        return $this->raza;
    }

    public function setRaza(?string $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface|string|null $fechaNacimiento): self
    {
        if (is_string($fechaNacimiento)) {
            $fechaNacimiento = date_create($fechaNacimiento);
        }

        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getDuenio(): ?Duenio
    {
        return $this->duenio;
    }

    public function setDuenio(?Duenio $duenio): self
    {
        $this->duenio = $duenio;

        return $this;
    }

    /**
     * @return Collection<int, Cita>
     */
    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addCita(Cita $cita): self
    {
        if (!$this->citas->contains($cita)) {
            $this->citas[] = $cita;
            $cita->setMascota($this);
        }

        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->removeElement($cita)) {
            // set the owning side to null (unless already changed)
            if ($cita->getMascota() === $this) {
                $cita->setMascota(null);
            }
        }

        return $this;
    }
}
