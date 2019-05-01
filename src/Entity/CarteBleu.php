<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarteBleuRepository")
 */
class CarteBleu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="cb", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $numero;

    /**
     * @ORM\Column(type="integer")
     */
    private $crypto;

    /**
     * @ORM\Column(type="text")
     */
    private $dateValidite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCrypto(): ?int
    {
        return $this->crypto;
    }

    public function setCrypto(int $crypto): self
    {
        $this->crypto = $crypto;

        return $this;
    }

    public function getDateValidite(): ?string
    {
        return $this->dateValidite;
    }

    public function setDateValidite(string $dateValidite): self
    {
        $this->dateValidite = $dateValidite;

        return $this;
    }
}
