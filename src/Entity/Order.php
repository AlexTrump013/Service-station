<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 * @ApiResource(
 *     normalizationContext={"groups"={"read", "carinfo", "jobs", "works", "person", "workstatus"}},
 *     denormalizationContext = {"groups"={"read", "carinfo", "jobs", "works", "person", "workstatus"}}
 * )
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read", "order"})
     */
    private $id;

    /**
     * @var Carinfo
     * @ORM\ManyToOne(targetEntity=Carinfo::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read", "carinfo"})
     */
    private $carinfo;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="_order", cascade={"persist"})
     * @Groups({"read"}, {"jobs"})
     */
    private $typejobs;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity=Person::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read"}, {"person"})
     */
    private $client;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity=Person::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read"}, {"person"})
     */
    private $master;

//    /**
//     * @ORM\OneToMany(targetEntity=Work::class, mappedBy="_order", cascade={"persist"})
//     * @Groups({"read"}, {"nowitwork"})
//     */
//    private $nowitwork;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $finalprice;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Workstatus::class, mappedBy="orders", cascade={"persist"})
     */
    private $workstatuses;

    /**
     * @Groups({"read"}, {"workstatus"})
     */
    private $nowItWork;

    public function __construct()
    {
        $this->typejobs = new ArrayCollection();
        $this->client = new ArrayCollection();
        $this->workstatuses = new ArrayCollection();
        $this->nowItWork = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarinfo(): ?Carinfo
    {
        return $this->carinfo;
    }

    public function setCarinfo(?Carinfo $carinfo): self
    {
        $this->carinfo = $carinfo;

        return $this;
    }
    /**
     * @return Collection|Job[]
     */
    public function getTypejobs(): Collection
    {
        return $this->typejobs;
    }

    public function addTypejob(Job $typejob): self
    {
        if (!$this->typejobs->contains($typejob)) {
            $this->typejobs[] = $typejob;
            $typejob->setOrder($this);
        }

        return $this;
    }

    public function removeTypejob(Job $typejob): self
    {
        if ($this->typejobs->removeElement($typejob)) {
            // set the owning side to null (unless already changed)
            if ($typejob->getOrder() === $this) {
                $typejob->setOrder(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Person
    {
        return $this->client;
    }

    public function setClient(?Person $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getMaster(): ?Person
    {
        return $this->master;
    }

    public function setMaster(?Person $master): self
    {
        $this->master = $master;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFinalprice(): ?int
    {
        return $this->finalprice;
    }

    public function setFinalprice(int $finalprice): self
    {
        $this->finalprice = $finalprice;

        return $this;
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

    /**
     * @return Collection|Workstatus[]
     */
    public function getWorkstatuses(): Collection
    {
        return $this->workstatuses;
    }

    public function addWorkstatus(Workstatus $workstatus): self
    {
        if (!$this->workstatuses->contains($workstatus)) {
            $this->workstatuses[] = $workstatus;
            $workstatus->addOrder($this);
        }

        return $this;
    }

    public function removeWorkstatus(Workstatus $workstatus): self
    {
        if ($this->workstatuses->removeElement($workstatus)) {
            $workstatus->removeOrder($this);
        }

        return $this;
    }

    /**
     * @return Collection|Workstatus[]
     */
    public function getNowItWork()
    {
        $this->nowItWork = $this->workstatuses->filter(function($element) {
            return $element['workstatus']=='nowitwork';
        });
        return $this->nowItWork;
    }

    public function addNowTtWork(Work $work): self
    {
        if (!$this->workstatuses->contains($work)) {
            $work->setStatus("nowitwork");
            $this->workstatuses[] = $work;
            $work->setOrder($this);
        }

        return $this;
    }

    public function removeNowItWork(Work $work): self
    {
        if ($this->workstatuses->removeElement($work)) {
            // set the owning side to null (unless already changed)
            if ($work->getOrder() === $this) {
                $work->setOrder(null);
            }
        }

        return $this;
    }

}
