<?php

namespace App\Entity;
use App\Repository\BonusRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BonusRepository::class)]
class Bonus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message :"ID PACK is required")]
    private ?int $bonus_id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message :"bonus1 is required")]
    private ?string $nomBonus1 = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message :"bonus2 is required")]
    private ?string $nomBonus2 = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message :"bonus3 is required")]
    private ?string $nomBonus3 = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message :"bonus4 is required")]
    private ?string $nomBonus4 = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Pack $bonus = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBonus_id(): ?int
    {
        return $this->bonus_id;
    }

    public function getNomBonus1(): ?string
    {
        return $this->nomBonus1;
    }

    public function setNomBonus1(string $nomBonus1): self
    {
        $this->nomBonus1 = $nomBonus1;

        return $this;
    }

    public function getNomBonus2(): ?string
    {
        return $this->nomBonus2;
    }

    public function setNomBonus2(string $nomBonus2): self
    {
        $this->nomBonus2 = $nomBonus2;

        return $this;
    }

    public function getNomBonus3(): ?string
    {
        return $this->nomBonus3;
    }

    public function setNomBonus3(string $nomBonus3): self
    {
        $this->nomBonus3 = $nomBonus3;

        return $this;
    }

    public function getNomBonus4(): ?string
    {
        return $this->nomBonus4;
    }

    public function setNomBonus4(string $nomBonus4): self
    {
        $this->nomBonus4 = $nomBonus4;

        return $this;
    }

    public function getBonus(): ?Pack
    {
        return $this->bonus;
    }

    public function setBonus(?Pack $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }


}
