<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
#[ApiResource]
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"person"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"person"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"person"})
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity=Carinfo::class, mappedBy="client")
     */
    private $carinfos;

    public function __construct()
    {
        $this->carinfos = new ArrayCollection();
    }

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Carinfo[]
     */
    public function getCarinfos(): Collection
    {
        return $this->carinfos;
    }

    public function addCarinfo(Carinfo $carinfo): self
    {
        if (!$this->carinfos->contains($carinfo)) {
            $this->carinfos[] = $carinfo;
            $carinfo->setClient($this);
        }

        return $this;
    }

    public function removeCarinfo(Carinfo $carinfo): self
    {
        if ($this->carinfos->removeElement($carinfo)) {
            // set the owning side to null (unless already changed)
            if ($carinfo->getClient() === $this) {
                $carinfo->setClient(null);
            }
        }

        return $this;
    }
}
