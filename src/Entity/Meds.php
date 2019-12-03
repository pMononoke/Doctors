<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Meds
 *
 * @ORM\Table(name="meds")
 * @ORM\Entity(repositoryClass="App\Entity\MedsRepository")
 */
class Meds
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    
   /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     */
    private $about;


    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;


    /**
     * @var \DateTime $expdate
     *
     * @ORM\Column(name="expdate", type="date")
     * @Gedmo\Timestampable(on="create")
     */
    protected $expdate;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\ConsultationMeds", mappedBy="meds", cascade={"remove", "persist"})
    */
    protected $consultationmeds;

    
    /************ constructeur ************/
    
    public function __construct()
    {
        $this->consultationmeds = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created = new \DateTime;
        $this->expdate = new \DateTime;
    }
    
    /************ getters & setters  ************/


    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * minus count
     *
     * @param string $count
     * @return Meds
     */
    public function minusCount($count)
    {
        $this->count -= $count;

        return $this;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setAbout(string $about): void
    {
        $this->about = $about;
    }

    public function getAbout(): string
    {
        return $this->about;
    }

    public function addConsultationmed(ConsultationMeds $consultationmeds): void
    {
        $this->consultationmeds[] = $consultationmeds;
    }

    public function removeConsultationmed(ConsultationMeds $consultationmeds): void
    {
        $this->consultationmeds->removeElement($consultationmeds);
    }

    public function getConsultationmeds(): Collection
    {
        return $this->consultationmeds;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function setExpdate(\DateTime $expdate): void
    {
        $this->expdate = $expdate;
    }

    public function getExpdate(): \DateTime
    {
        return $this->expdate;
    }

    public function isExpired(): bool
    {
        return ($this->expdate <= new \DateTime());
    }
}
