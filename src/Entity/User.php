<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var UserId
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="userId")     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string|null The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserProfile", cascade={"persist", "remove"})
     */
    private $profile;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $accountStatus;

    public function __construct(?UserId $userId = null)
    {
        $this->id = $userId ?? UserId::generate();
        $this->accountStatus = false;
    }

    public function setId(UserId $userId): self
    {
        $this->id = $userId;

        return $this;
    }

    public function getId(): UserId
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    private function getProfile(): ?UserProfile
    {
        return $this->profile;
    }

    private function setProfile(?UserProfile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function isActiveAccount(): bool
    {
        return $this->accountStatus;
    }

    public function setAccountStatus(bool $accountStatus): void
    {
        $this->accountStatus = $accountStatus;
    }

    public function setFirstName(string $firstName): void
    {
        $profile = $this->getProfile() ?? new UserProfile();
        $profile->setFirstName($firstName);
        $this->setProfile($profile);
    }

    public function getFirstName(): ?string
    {
        if (!$this->profile) {
            return null;
        }
        $userProfile = $this->getProfile();

        return $userProfile->getFirstName();
    }

    public function setLastName(string $lastName): void
    {
        $profile = $this->getProfile() ?? new UserProfile();
        $profile->setLastName($lastName);
        $this->setProfile($profile);
    }

    public function getLastName(): ?string
    {
        if (!$this->profile) {
            return null;
        }
        $userProfile = $this->getProfile();

        return $userProfile->getLastName();
    }
}
