<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    private ?string $password = null;

    // Single role stored as string, matches your database column
    #[ORM\Column(type: "string", length: 20)]
    private ?string $roles = null;

    #[ORM\Column(length: 200)]
    private ?string $fullname = null;

    #[ORM\Column(length: 200)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $address = null;

    /**
     * @var Collection<int, Servicebooking>
     */
    #[ORM\OneToMany(targetEntity: Servicebooking::class, mappedBy: 'customername')]
    private Collection $servicebookings;

    public function __construct()
    {
        $this->servicebookings = new ArrayCollection();
    }

    // --------------------
    // BASIC GETTERS/SETTERS
    // --------------------
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        // Convert single string role into array for Symfony
        return [$this->roles ?? 'ROLE_CUSTOMER'];
    }

    public function setRoles(string $roles): static
    {
        $allowedRoles = ['ROLE_ADMIN', 'ROLE_CUSTOMER'];
        if (!in_array($roles, $allowedRoles, true)) {
            throw new \InvalidArgumentException("Invalid role: $roles");
        }
        $this->roles = $roles;
        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): static
    {
        $this->fullname = $fullname;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;
        return $this;
    }

    // --------------------
    // RELATIONSHIP METHODS
    // --------------------
    public function getServicebookings(): Collection
    {
        return $this->servicebookings;
    }

    public function addServicebooking(Servicebooking $servicebooking): static
    {
        if (!$this->servicebookings->contains($servicebooking)) {
            $this->servicebookings->add($servicebooking);
            $servicebooking->setCustomername($this);
        }
        return $this;
    }

    public function removeServicebooking(Servicebooking $servicebooking): static
    {
        if ($this->servicebookings->removeElement($servicebooking)) {
            if ($servicebooking->getCustomername() === $this) {
                $servicebooking->setCustomername(null);
            }
        }
        return $this;
    }

    // --------------------
    // REQUIRED INTERFACE METHODS
    // --------------------

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        // Clear sensitive data here if needed
    }

    public function getSalt(): ?string
    {
        // Not needed when using bcrypt/argon2i/argon2id
        return null;
    }

    public function __toString(): string
    {
        return $this->fullname ?? $this->email ?? 'User';
    }
}
