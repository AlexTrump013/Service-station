<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CarinfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CarinfoRepository::class)
 * @vich\Uploadable
 * @ApiResource(
 *     normalizationContext={"groups"={"carinfo", "person"}},
 *     denormalizationContext = {"groups"={"carinfo", "person"}}
 * )
 */
class Carinfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"carinfo"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"carinfo"})
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"carinfo"})
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"carinfo"})
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"carinfo"})
     */
    private $vincode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"carinfo"})
     */
    private $numder;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="carinfos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"carinfo", "person"})
     */
    private $client;


//    /**string"
//  }
//     * @ORM\Column(type="string",length=255, nullable=true)
//     * @Groups({"carinfo"})
//     */
//    private $image;
//
//    /**
//     * @Vich\UploadableField(mapping="car", fileNameProperty="image")
//     * @var File
//     * @Groups({"carinfo"})
//     */
//    private $imageFile;


    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getVincode(): ?string
    {
        return $this->vincode;
    }

    public function setVincode(string $vincode): self
    {
        $this->vincode = $vincode;

        return $this;
    }

    public function getNumder(): ?string
    {
        return $this->numder;
    }

    public function setNumder(string $numder): self
    {
        $this->numder = $numder;

        return $this;
    }


//    /**
//     * @return string|null
//     */
//    public function getImage(): ?string
//    {
//        return $this->image;
//    }
//
//    /**
//     * @param string|null $image
//     * @return $this
//     */
//    public function setImage(?string $image):self
//    {
//        $this->image= $image;
//        return $this;
//    }
//
//    /**
//     * @return File|null
//     */
//    public function getImageFile(): ?File
//    {
//        return $this->imageFile;
//    }
//
//    /**
//     * @param File|null $imageFile
//     */
//    public function setImageFile(?File $imageFile= null)
//    {
//        $this->imageFile= $imageFile;
//    }

public function getClient(): ?Person
{
    return $this->client;
}

public function setClient(?Person $client): self
{
    $this->client = $client;

    return $this;
}


    
}
