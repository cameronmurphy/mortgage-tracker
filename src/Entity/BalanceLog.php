<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BalanceLogRepository")
 */
class BalanceLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $loanBalance;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $offsetBalance;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoanBalance()
    {
        return $this->loanBalance;
    }

    public function setLoanBalance($loanBalance): self
    {
        $this->loanBalance = $loanBalance;

        return $this;
    }

    public function getOffsetBalance()
    {
        return $this->offsetBalance;
    }

    public function setOffsetBalance($offsetBalance): self
    {
        $this->offsetBalance = $offsetBalance;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
