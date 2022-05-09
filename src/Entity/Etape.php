<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtapeRepository::class)
 */
class Etape
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $depart;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $arrival;

    /**
     * @ORM\Column(type="datetime")
     */
    private $depart_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrival_date;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $seat;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $gate;

    /**
     * @ORM\ManyToOne(targetEntity=Voyages::class, inversedBy="etapes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voyage;

    /**
     * @ORM\OneToOne(targetEntity=Transport::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $transport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getArrival(): ?string
    {
        return $this->arrival;
    }

    public function setArrival(string $arrival): self
    {
        $this->arrival = $arrival;

        return $this;
    }

    public function getDepartDate(): ?\DateTimeInterface
    {
        return $this->depart_date;
    }

    public function setDepartDate(\DateTimeInterface $depart_date): self
    {
        $this->depart_date = $depart_date;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrival_date;
    }

    public function setArrivalDate(\DateTimeInterface $arrival_date): self
    {
        $this->arrival_date = $arrival_date;

        return $this;
    }

    public function getSeat(): ?string
    {
        return $this->seat;
    }

    public function setSeat(?string $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    public function getGate(): ?string
    {
        return $this->gate;
    }

    public function setGate(?string $gate): self
    {
        $this->gate = $gate;

        return $this;
    }

    public function getVoyage(): ?Voyages
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyages $voyage): self
    {
        $this->voyage = $voyage;

        return $this;
    }

    public function getTransport(): ?Transport
    {
        return $this->transport;
    }

    public function setTransport(Transport $transport): self
    {
        $this->transport = $transport;

        return $this;
    }
}
