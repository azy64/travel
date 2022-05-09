<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransportRepository::class)
 */
class Transport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity=TypeTransport::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_transport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getTypeTransport(): ?TypeTransport
    {
        return $this->type_transport;
    }

    public function setTypeTransport(?TypeTransport $type_transport): self
    {
        $this->type_transport = $type_transport;

        return $this;
    }
}
