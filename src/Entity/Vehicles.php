<?php

namespace App\Entity;

use App\Repository\VehiclesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiclesRepository::class)]
class Vehicles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $plate = null;

    #[ORM\Column(length: 1)]
    private ?string $licenseRequired = null;
    
    #[ORM\OneToOne(mappedBy: 'vehicle', cascade: ['persist', 'remove'])]
    private ?Trip $trip = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): static
    {
        $this->plate = $plate;

        return $this;
    }

    public function getLicenseRequired(): ?string
    {
        return $this->licenseRequired;
    }

    public function setLicenseRequired(string $licenseRequired): static
    {
        $this->licenseRequired = $licenseRequired;

        return $this;
    }
    
    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(Trip $trip): static
    {
        // set the owning side of the relation if necessary
        if ($trip->getVehicle() !== $this) {
            $trip->setVehicle($this);
        }

        $this->trip = $trip;

        return $this;
    }
}
