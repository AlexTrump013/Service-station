<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WorkstatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=WorkstatusRepository::class)
 * @ORM\Table(name="`workstatus`")
 * @ApiResource(
 *     normalizationContext={"groups"={"read","workstatus"}},
 *     denormalizationContext = {"groups"={"read","workstatus"}}
 * )
 */
class Workstatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"}, {"workstatus"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"}, {"workstatus"})
     */
    private $status;

    /**
     * @var Work
     * @ORM\ManyToOne(targetEntity=Work::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read", "workstatus"})
     * @Assert\NotBlank()
     * @Assert\Type(type="App\Entity\Work")
     */
    private $work;

    /**
     * @ORM\ManyToMany(targetEntity=Order::class, inversedBy="workstatuses")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getWork(): ?Work
    {
        return $this->work;
    }

    public function setWork(?Work $work): self
    {
        $this->work = $work;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        $this->orders->removeElement($order);

        return $this;
    }
    
}
