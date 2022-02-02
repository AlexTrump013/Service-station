<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
#[ApiResource]
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"jobs"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"jobs"})
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"jobs"})
     */
    private $pricework;

    /**
     * @var Order
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="typejobs")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     * @Assert\Type(type="App\Entity\Order")
     */
    private $_order;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPricework(): ?int
    {
        return $this->pricework;
    }

    public function setPricework(int $pricework): self
    {
        $this->pricework = $pricework;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->_order;
    }

    public function setOrder(?Order $_order): self
    {
        $this->_order = $_order;

        return $this;
    }
}
