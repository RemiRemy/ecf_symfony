<?php

namespace App\Entity;

use App\Repository\LibelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LibelleRepository::class)
 */
class Libelle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="libelles")
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleur;

    public function __construct()
    {
        $this->libelle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection|Produit[]
     */
    public function getLibelle(): Collection
    {
        return $this->libelle;
    }

    public function addLibelle(Produit $libelle): self
    {
        if (!$this->libelle->contains($libelle)) {
            $this->libelle[] = $libelle;
        }

        return $this;
    }

    public function removeLibelle(Produit $libelle): self
    {
        $this->libelle->removeElement($libelle);

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }
}
