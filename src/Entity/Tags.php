<?php

namespace App\Entity;

use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagsRepository::class)]
class Tags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tag = null;

    #[ORM\ManyToMany(targetEntity: FavCardsPublic::class, mappedBy: 'Tag')]
    private Collection $favCardsPublics;

    #[ORM\ManyToMany(targetEntity: FavCardsPrivate::class, mappedBy: 'Tag')]
    private Collection $favCardsPrivates;

    public function __construct()
    {
        $this->favCardsPublics = new ArrayCollection();
        $this->favCardsPrivates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): static
    {
        $this->tag = $tag;

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
}
