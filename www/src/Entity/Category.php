<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, Clothing>
     */
    #[ORM\OneToMany(targetEntity: Clothing::class, mappedBy: 'categories')]
    private Collection $clothings;

    public function __construct()
    {
        $this->clothings = new ArrayCollection();
    }

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
            $clothing->setCategories($this);
        }

        return $this;
    }

    public function removeClothing(Clothing $clothing): static
    {
        if ($this->clothings->removeElement($clothing)) {
            // set the owning side to null (unless already changed)
            if ($clothing->getCategories() === $this) {
                $clothing->setCategories(null);
            }
        }

        return $this;
    }

}
