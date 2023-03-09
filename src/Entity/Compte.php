<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=CompteRepository::class) 
 * @UniqueEntity(fields={"numeroCompte"}, message="le numero du compte  deja existe")
 * @UniqueEntity(fields={"rib"}, message="le rib deja existe")
 */
class Compte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")
     */
    private $balance;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $etat;

    /**
     * @ORM\Column( type="bigint", nullable=false ,unique=true)
     * @Assert\Length(
     *      min = 16,
     *      max = 16,
     *      minMessage = "Le numéro de compte doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "Le numéro de compte doit contenir au plus {{ limit }} caractères."
     * )   
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")
     */
    private $numeroCompte;

    /**
     * @var int
     *
     * @ORM\Column(name="rib", type="bigint", nullable=false,length=20)
     * @Assert\Length(
     *      min = 13,
     *      max = 13,
     *      minMessage = "Le numéro de compte doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "Le numéro de compte doit contenir au plus {{ limit }} caractères."
     * )    
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")

     */
    private $rib;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNumeroCompte(): ?int
    {
        return $this->numeroCompte;
    }

    public function setNumeroCompte(int $numeroCompte): self
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }

    public function getRib(): ?int
    {
        return $this->rib;
    }

    public function setRib(int $rib): self
    {
        $this->rib = $rib;

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
