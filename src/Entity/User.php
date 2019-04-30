<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $painPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="vendeur", orphanRemoval=true)
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="acheteur")
     */
    private $panier;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->panier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPainPassword(): ?string
    {
        return $this->painPassword;
    }

    public function setPainPassword(string $painPassword): self
    {
        $this->painPassword = $painPassword;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setVendeur($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getVendeur() === $this) {
                $product->setVendeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getPanier(): Collection
    {
        return $this->panier;
    }

    public function addPanier(Product $panier): self
    {
        if (!$this->panier->contains($panier)) {
            $this->panier[] = $panier;
            $panier->setAcheteur($this);
        }

        return $this;
    }

    public function removePanier(Product $panier): self
    {
        if ($this->panier->contains($panier)) {
            $this->panier->removeElement($panier);
            // set the owning side to null (unless already changed)
            if ($panier->getAcheteur() === $this) {
                $panier->setAcheteur(null);
            }
        }

        return $this;
    }
}
