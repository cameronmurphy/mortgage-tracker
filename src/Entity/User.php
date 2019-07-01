<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(
 *     name="`user`",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"username"})
 *     }
 * )
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
     * @var string
     *
     * @ORM\Column
     */
    private $username;

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

    /**
     * @var string
     *
     * @ORM\Column(nullable=true)
     */
    private $apiKey;

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

    public function eraseCredentials()
    {
        // Nothing unecrypted on the Entity :)
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
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
        return serialize([$this->id, $this->username, $this->password]);
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->username, $this->password) = unserialize($serialized);
    }
}
