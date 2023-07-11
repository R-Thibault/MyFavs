<?php

namespace App\Entity;

use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\DocBlock\Tag;

#[ORM\Entity(repositoryClass: TagsRepository::class)]
class Tags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: FavCardsPublic::class, mappedBy: 'Tag')]
    private Collection $favCardsPublics;

    #[ORM\ManyToMany(targetEntity: FavCardsPrivate::class, mappedBy: 'Tag')]
    private Collection $favCardsPrivates;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->favCardsPublics = new ArrayCollection();
        $this->favCardsPrivates = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, FavCardsPublic>
     */
    public function getFavCardsPublics(): Collection
    {
        return $this->favCardsPublics;
    }

    public function addFavCardsPublic(FavCardsPublic $favCardsPublic): static
    {
        if (!$this->favCardsPublics->contains($favCardsPublic)) {
            $this->favCardsPublics->add($favCardsPublic);
            $favCardsPublic->addTag($this);
        }

        return $this;
    }

    public function removeFavCardsPublic(FavCardsPublic $favCardsPublic): static
    {
        if ($this->favCardsPublics->removeElement($favCardsPublic)) {
            $favCardsPublic->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, FavCardsPrivate>
     */
    public function getFavCardsPrivates(): Collection
    {
        return $this->favCardsPrivates;
    }

    public function addFavCardsPrivate(FavCardsPrivate $favCardsPrivate): static
    {
        if (!$this->favCardsPrivates->contains($favCardsPrivate)) {
            $this->favCardsPrivates->add($favCardsPrivate);
            $favCardsPrivate->addTag($this);
        }

        return $this;
    }

    public function removeFavCardsPrivate(FavCardsPrivate $favCardsPrivate): static
    {
        if ($this->favCardsPrivates->removeElement($favCardsPrivate)) {
            $favCardsPrivate->removeTag($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    

    
}
