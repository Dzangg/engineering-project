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
    private ?string $name = null;

    /**
     * @var Collection<int, Gesture>
     */
    #[ORM\OneToMany(targetEntity: Gesture::class, mappedBy: 'category')]
    private Collection $gestures;

    public function __construct()
    {
        $this->gestures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Gesture>
     */
    public function getGestures(): Collection
    {
        return $this->gestures;
    }

    public function addGesture(Gesture $gesture): static
    {
        if (!$this->gestures->contains($gesture)) {
            $this->gestures->add($gesture);
            $gesture->setCategory($this);
        }

        return $this;
    }

    public function removeGesture(Gesture $gesture): static
    {
        if ($this->gestures->removeElement($gesture)) {
            // set the owning side to null (unless already changed)
            if ($gesture->getCategory() === $this) {
                $gesture->setCategory(null);
            }
        }

        return $this;
    }
}
