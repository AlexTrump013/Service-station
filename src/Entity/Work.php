<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WorkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WorkRepository::class)
 */
#[ApiResource]
class Work
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"workstatus"})
     */
    private $id;

    /**
     * @Groups({"workstatus"})
     * @ORM\Column(type="string", length=255)
     */
    private $title;



//    /**
//      * @var Order
//      * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="finishedwork")
//      * @ORM\JoinColumn(nullable=false)
//      * @Assert\NotBlank()
//      * @Assert\Type(type="App\Entity\Order")
//     */
//    private $_order;

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

//    public function getOrder(): ?Order
//    {
//        return $this->_order;
//    }
//
//    public function setOrder(?Order $_order): self
//    {
//        $this->_order = $_order;
//
//        return $this;
//    }


}
