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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Category
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @var Collection<int, Gesture>
     */
    #[ORM\ManyToMany(targetEntity: Gesture::class, inversedBy: 'categories')]
    private Collection $gestures;

    public function __construct()
    {
        $this->gestures = new ArrayCollection();
    }

    public function getGestures(): Collection
    {
        return $this->gestures;
    }

    public function addGesture(Gesture $gesture): self
    {
        if (!$this->gestures->contains($gesture)) {
            $this->gestures->add($gesture);
            $gesture->addCategory($this);
        }

        return $this;
    }

    public function removeGesture(Gesture $gesture): self
    {
        if ($this->gestures->removeElement($gesture)) {
            $gesture->removeCategory($this);
        }

        return $this;
    }
}
