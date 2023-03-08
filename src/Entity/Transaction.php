<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $rib_des = null;

    #[ORM\Column(nullable: true)]
    private ?int $rib_env = null;

    #[ORM\Column(nullable: true)]
    private ?int $montant = null;

     #[ORM\ManyToOne(inversedBy: 'transactions')]
     private ?CompteBancaire $CompteB = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRibDes(): ?int
    {
        return $this->rib_des;
    }

    public function setRibDes(?int $rib_des): self
    {
        $this->rib_des = $rib_des;

        return $this;
    }

    public function getRibEnv(): ?int
    {
        return $this->rib_env;
    }

    public function setRibEnv(?int $rib_env): self
    {
        $this->rib_env = $rib_env;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(?int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

     public function getCompteB(): ?CompteBancaire
     {
         return $this->CompteB;
     }

     public function setCompteB(?CompteBancaire $CompteB): self
     {
         $this->CompteB = $CompteB;

         return $this;
     }
}
