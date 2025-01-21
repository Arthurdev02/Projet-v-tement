<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $averageRating = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $userRating = null;

    /**
     * @var Collection<int, Clothing>
     */
    #[ORM\OneToMany(targetEntity: Clothing::class, mappedBy: 'Notes')]
    private Collection $clothings;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    private ?User $Users = null;

    public function __construct()
    {
        $this->clothings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAverageRating(): ?string
    {
        return $this->averageRating;
    }

    public function setAverageRating(string $averageRating): static
    {
        $this->averageRating = $averageRating;

        return $this;
    }

    public function getUserRating(): ?string
    {
        return $this->userRating;
    }

    public function setUserRating(string $userRating): static
    {
        $this->userRating = $userRating;

        return $this;
    }

    /**
     * @return Collection<int, Clothing>
     */
    public function getClothings(): Collection
    {
        return $this->clothings;
    }

    public function addClothing(Clothing $clothing): static
    {
        if (!$this->clothings->contains($clothing)) {
            $this->clothings->add($clothing);
            $clothing->setNotes($this);
        }

        return $this;
    }

    public function removeClothing(Clothing $clothing): static
    {
        if ($this->clothings->removeElement($clothing)) {
            // set the owning side to null (unless already changed)
            if ($clothing->getNotes() === $this) {
                $clothing->setNotes(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->Users;
    }

    public function setUsers(?User $Users): static
    {
        $this->Users = $Users;

        return $this;
    }
    public function setUser(?User $user): static
    {
        $this->Users = $user;

        return $this;
    }
}
