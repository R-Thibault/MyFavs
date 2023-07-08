<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nickname = null;

    #[ORM\OneToMany(mappedBy: 'Author', targetEntity: FavCardsPublic::class, orphanRemoval: true)]
    private Collection $favCardsPublics;

    #[ORM\OneToMany(mappedBy: 'Author', targetEntity: FavCardsPrivate::class, orphanRemoval: true)]
    private Collection $favCardsPrivates;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function __construct()
    {
        $this->favCardsPublics = new ArrayCollection();
        $this->favCardsPrivates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): static
    {
        $this->nickname = $nickname;

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
            $favCardsPublic->setAuthor($this);
        }

        return $this;
    }

    public function removeFavCardsPublic(FavCardsPublic $favCardsPublic): static
    {
        if ($this->favCardsPublics->removeElement($favCardsPublic)) {
            // set the owning side to null (unless already changed)
            if ($favCardsPublic->getAuthor() === $this) {
                $favCardsPublic->setAuthor(null);
            }
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
            $favCardsPrivate->setAuthor($this);
        }

        return $this;
    }

    public function removeFavCardsPrivate(FavCardsPrivate $favCardsPrivate): static
    {
        if ($this->favCardsPrivates->removeElement($favCardsPrivate)) {
            // set the owning side to null (unless already changed)
            if ($favCardsPrivate->getAuthor() === $this) {
                $favCardsPrivate->setAuthor(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNickname();
    }
}
