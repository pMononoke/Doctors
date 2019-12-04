<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Consultation.
 *
 * @ORM\Table(name="consultation")
 * @ORM\Entity(repositoryClass="App\Entity\ConsultationRepository")
 */
class Consultation
{
    public static $GENERAL = 'Consultation generale';
    public static $SPECIAL = 'Consultation spécialisé';

    /**
     * @var int
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
     * @var string
     *
     * @ORM\Column(name="motiftype", type="string", length=255, nullable=true)
     */
    private $motiftype;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="infrastructure", type="string", length=255, nullable=true)
     */
    private $infrastructure;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="date")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnosis", type="text", nullable=true)
     */
    private $diagnosis;

    /**
     * @var string
     *
     * @ORM\Column(name="treatment", type="text", nullable=true)
     */
    private $treatment;

    /**
     * @var string
     *
     * @ORM\Column(name="decision", type="text", nullable=true)
     */
    private $decision;

    /**
     * @var bool
     *
     * @ORM\Column(name="chronic", type="boolean", nullable=true)
     */
    private $chronic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="consultations")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=false)
     * @var Person
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="consultations")
     * @ORM\JoinColumn(name="doc_id", referencedColumnName="id", nullable=false)
     * @var User
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Test", mappedBy="consultation", cascade={"remove", "persist"})
     * @var Collection|Test[]
     */
    protected $tests;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ConsultationMeds", mappedBy="consultation", cascade={"remove", "persist"})
     * @var Collection|ConsultationMeds[]
     */
    protected $consultationmeds;

    /************ constructeur ************/

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->type = Consultation::$GENERAL;
        $this->tests = new ArrayCollection();
        $this->consultationmeds = new ArrayCollection();
    }

    /************ getters & setters  ************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function addTest(Test $tests): void
    {
        $this->tests[] = $tests;
    }

    public function removeTest(Test $tests): void
    {
        $this->tests->removeElement($tests);
    }


    /**
     * @return Collection|Test[]|null
     */
    public function getTests(): ?Collection
    {
        return $this->tests;
    }

    public function addConsultationmed(ConsultationMeds $consultationmeds): void
    {
        $consultationmeds->setConsultation($this);
        $this->consultationmeds->add($consultationmeds);
    }

    public function removeConsultationmed(ConsultationMeds $consultationmeds): void
    {
        $this->consultationmeds->removeElement($consultationmeds);
    }

    /**
     * @return Collection|ConsultationMeds[]|null
     */
    public function getConsultationmeds(): ?Collection
    {
        return $this->consultationmeds;
    }

    public function setDiagnosis(string $diagnosis): void
    {
        $this->diagnosis = $diagnosis;
    }

    public function getDiagnosis(): ?string
    {
        return $this->diagnosis;
    }

    public function setTreatment(string $treatment): void
    {
        $this->treatment = $treatment;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setMotiftype(string $motiftype): void
    {
        $this->motiftype = $motiftype;
    }

    public function getMotiftype(): ?string
    {
        return $this->motiftype;
    }

    public function setInfrastructure(string $infrastructure): void
    {
        $this->infrastructure = $infrastructure;
    }

    public function getInfrastructure(): ?string
    {
        return $this->infrastructure;
    }

    public function isSpecial(): ?bool
    {
        return $this->type === Consultation::$SPECIAL;
    }

    public function setChronic(bool $chronic): void
    {
        $this->chronic = $chronic;
    }

    public function getChronic(): ?bool
    {
        return $this->chronic;
    }

    public function setDecision(string $decision): void
    {
        $this->decision = $decision;
    }

    public function getDecision(): ?string
    {
        return $this->decision;
    }
}
