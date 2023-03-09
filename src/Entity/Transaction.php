<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 */


class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $sourceAccount;

    /**
     * @ORM\Column(type="float")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")
     */
    private $destinationAccount;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")
     */
    private $amount;

    /**
     *@var \DateTime

     * @ORM\Column(type="datetime")
     */
    private $createdAt;



    // getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSourceAccount(): ?Compte
    {
        return $this->sourceAccount;
    }

    public function setSourceAccount(?Compte $sourceAccount): self
    {
        $this->sourceAccount = $sourceAccount;

        return $this;
    }

    public function getDestinationAccount(): ?int
    {
        return $this->destinationAccount;
    }

    public function setDestinationAccount(?int $destinationAccount): self
    {
        $this->destinationAccount = $destinationAccount;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    


}