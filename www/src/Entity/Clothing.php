<?php

namespace App\Entity;

use App\Repository\ClothingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClothingRepository::class)]
class Clothing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releasDate = null;

    #[ORM\Column(length: 255)]
    private ?string $imagePath = null;

    #[ORM\ManyToOne(inversedBy: 'clothings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $categories = null;

    #[ORM\ManyToOne(inversedBy: 'clothings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Size $Sizes = null;

    #[ORM\ManyToOne(inversedBy: 'clothings')]
    private ?Note $Notes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getReleasDate(): ?\DateTimeInterface
    {
        return $this->releasDate;
    }

    public function setReleasDate(\DateTimeInterface $releasDate): static
    {
        $this->releasDate = $releasDate;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    public function getSizes(): ?Size
    {
        return $this->Sizes;
    }

    public function setSizes(?Size $Sizes): static
    {
        $this->Sizes = $Sizes;

        return $this;
    }

    public function getNotes(): ?Note
    {
        return $this->Notes;
    }

    public function setNotes(?Note $Notes): static
    {
        $this->Notes = $Notes;

        return $this;
    }
}
