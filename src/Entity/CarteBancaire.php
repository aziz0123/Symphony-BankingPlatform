<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * CarteBancaire
 *
 * @ORM\Table(name="carte_bancaire", indexes={@ORM\Index(name="ff", columns={"id_type"})})
 * @UniqueEntity(fields={"email"}, message="le email deja existe")
 * @UniqueEntity(fields={"numCarte"}, message="le numero du compte  deja existe")
 * @UniqueEntity(fields={"cvv"}, message="le cvv deja existe")
 * @ORM\Entity
 * 
 */

class CarteBancaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=200, nullable=false )
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")
     */

    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="num_carte", type="integer", length=16, nullable=false , unique=true)
     * @Assert\Length(
     *      min = 16,
     *      max = 16,
     *      minMessage = "Le numéro de compte doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "Le numéro de compte doit contenir au plus {{ limit }} caractères."
     * )      
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")
     */
    private $numCarte;

    /**
     * @var int
     *
     * @ORM\Column(name="cvv", type="integer",nullable=false )
     * @Assert\Length(
     *      min = 3,
     *      max = 3,
     *      minMessage = "Le numéro de compte doit contenir au moins {{ limit }} caractères.",
     *      maxMessage = "Le numéro de compte doit contenir au plus {{ limit }} caractères."
     * )      
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")

     */
    private $cvv;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30, nullable=false )
     * @Assert\NotBlank(message="ce champs ne doit pas etre vide")
     */

    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \Type
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id",onDelete="CASCADE")
     * })

     */
    private $idType;

    /**
     * @ORM\ManyToOne(targetEntity="Compte",)
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="compte", referencedColumnName="id",onDelete="CASCADE")
     * })   

     */
    private $compte;

    /**
     * @ORM\Column(type="date",nullable=true)
     * @Assert\GreaterThan("today")]
     */
    private $DateExp;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $etat;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {

        $this->nom = $nom;

        return $this;
    }


    public function getNumCarte(): ?int
    {
        return $this->numCarte;
    }

    public function setNumCarte(int $numCarte): self
    {
        $this->numCarte = $numCarte;

        return $this;
    }

    public function getCvv(): ?int
    {
        return $this->cvv;
    }

    public function setCvv(int $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdType()
    {
        return $this->idType;
    }

    public function setIdType(?Type $idType): self
    {
        $this->idType = $idType;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getDateExp(): ?\DateTimeInterface
    {
        return $this->DateExp;
    }

    public function setDateExp(\DateTimeInterface $DateExp): self
    {
        $this->DateExp = $DateExp;

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

}
