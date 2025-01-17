<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $averayRating = null;

    #[ORM\Column]
    private ?int $userRating = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'note')]
    private Collection $users;

    /**
     * @var Collection<int, Clothing>
     */
    #[ORM\OneToMany(targetEntity: Clothing::class, mappedBy: 'note')]
    private Collection $clothings;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->clothings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAverayRating(): ?int
    {
        return $this->averayRating;
    }

    public function setAverayRating(int $averayRating): static
    {
        $this->averayRating = $averayRating;

        return $this;
    }

    public function getUserRating(): ?int
    {
        return $this->userRating;
    }

    public function setUserRating(int $userRating): static
    {
        $this->userRating = $userRating;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setNote($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getNote() === $this) {
                $user->setNote(null);
            }
        }

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
            $clothing->setNote($this);
        }

        return $this;
    }

    public function removeClothing(Clothing $clothing): static
    {
        if ($this->clothings->removeElement($clothing)) {
            // set the owning side to null (unless already changed)
            if ($clothing->getNote() === $this) {
                $clothing->setNote(null);
            }
        }

        return $this;
    }
}
