<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class User implements UserInterface, \Serializable
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
    private $name;

    /**
     * @var string
     *
     * @ORM\Column
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column
     */
    private $password;

    /**
     * @var string[]
     *
     * @ORM\Column(type="json_array")
     */
    private $roles;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $invalidPasswordAttemptCount;

    public function __construct()
    {
        $this->roles = [];
        $this->invalidPasswordAttemptCount = 0;
    }

    public function addRole(string $role): self
    {
        $this->roles[] = $role;
        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvalidPasswordAttemptCount(): int
    {
        return $this->invalidPasswordAttemptCount;
    }

    public function setInvalidPasswordAttemptCount(int $invalidPasswordAttemptCount): self
    {
        $this->invalidPasswordAttemptCount = $invalidPasswordAttemptCount;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function removeRole(string $role): self
    {
        $index = array_search($role, $this->roles);

        if (false !== $index){
            unset($this->roles[$index]);
        }

        return $this;
    }

    public function serialize()
    {
        return serialize([$this->id, $this->email, $this->password]);
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->email, $this->password) = unserialize($serialized);
    }
}
