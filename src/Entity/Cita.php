<?php

namespace App\Entity;

use App\Repository\CitaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Traversable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CitaRepository::class)
 */
class Cita
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=Mascota::class, inversedBy="citas")
     * @Assert\NotBlank()
     */
    private $mascota;

    /**
     * @ORM\ManyToMany(targetEntity=Tratamiento::class, inversedBy="citas")
     * @Assert\NotBlank()
     *
     */
    private $tratamientos;

    /**
     * @ORM\ManyToOne(targetEntity=Veterinario::class, inversedBy="citas")
     * @Assert\NotBlank()
     */
    private $veterinario;

    public function __construct()
    {
        $this->tratamientos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getMascota(): ?Mascota
    {
        return $this->mascota;
    }

    public function setMascota(?Mascota $mascota): self
    {
        $this->mascota = $mascota;

        return $this;
    }

    /**
     * @return Collection<int, Tratamiento>
     */
    public function getTratamientos(): array
    {
        return $this->tratamientos->toArray();
    }

    public function addTratamiento(Tratamiento $tratamiento): self
    {
        if (!$this->tratamientos->contains($tratamiento)) {
            $this->tratamientos[] = $tratamiento;
        }

        return $this;
    }

    public function removeTratamiento(Tratamiento $tratamiento): self
    {
        $this->tratamientos->removeElement($tratamiento);

        return $this;
    }

    public function getVeterinario(): ?Veterinario
    {
        return $this->veterinario;
    }

    public function setVeterinario(?Veterinario $veterinario): self
    {
        $this->veterinario = $veterinario;

        return $this;
    }
}
