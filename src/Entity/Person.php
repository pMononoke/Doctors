<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Person.
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
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
     * @ORM\Column(name="cin", type="string", length=255)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="cne", type="string", length=255)
     */
    private $cne;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="familyname", type="string", length=255)
     */
    private $familyname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="birthcity", type="string", length=255, nullable=true)
     */
    private $birthcity;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="contry", type="string", length=255, nullable=true)
     */
    private $contry;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="etablissement", type="string", length=255, nullable=true)
     */
    private $etablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="university", type="string", length=255, nullable=true)
     */
    private $university;

    /**
     * @var string
     *
     * @ORM\Column(name="gsm", type="string", length=255, nullable=true)
     */
    private $gsm;

    /**
     * @var string
     *
     * @ORM\Column(name="cnss", type="string", length=255)
     */
    private $cnss;

    /**
     * @var string
     *
     * @ORM\Column(name="cnsstype", type="string", length=255)
     */
    private $cnsstype;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_name", type="string", length=255, nullable=true)
     */
    private $parentName;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_address", type="string", length=255, nullable=true)
     */
    private $parentAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_gsm", type="string", length=255, nullable=true)
     */
    private $parentGsm;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_fixe", type="string", length=255, nullable=true)
     */
    private $parentFixe;

    /**
     * @var bool
     * @ORM\Column(name="ishandicap", type="boolean", nullable=true)
     */
    private $ishandicap;

    /**
     * @var string
     *
     * @ORM\Column(name="handicap", type="string", length=255, nullable=true)
     */
    private $handicap;

    /**
     * @var string
     *
     * @ORM\Column(name="needs", type="text", nullable=true)
     */
    private $needs;

    /**
     * @var bool
     *
     * @ORM\Column(name="resident", type="boolean")
     */
    private $resident;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Antecedent", mappedBy="person", cascade={"remove", "persist"})
     * @var Collection|Antecedent[]
     */
    protected $antecedents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consultation", mappedBy="person", cascade={"remove", "persist"})
     * @var Collection|Consultation[]
     */
    protected $consultations;

    /************ constructeur ************/

    public function __construct()
    {
        $this->birthday = new \DateTime();
        $this->created = new \DateTime();
        $this->antecedents = new ArrayCollection();
        $this->consultations = new ArrayCollection();
    }

    /************ getters & setters  ************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): ?string
    {
        return $this->getFullName();
    }

    public function setCin(string $cin): void
    {
        $this->cin = $cin;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCne(string $cne): void
    {
        $this->cne = $cne;
    }

    public function getCne(): ?string
    {
        return $this->cne;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFamilyname(string $familyname): void
    {
        $this->familyname = $familyname;
    }

    public function getFamilyname(): ?string
    {
        return $this->familyname;
    }

    public function getFullName(): ?string
    {
        return $this->familyname.' '.$this->firstname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setBirthday(\DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    public function setBirthcity(string $birthcity): void
    {
        $this->birthcity = $birthcity;
    }

    public function getBirthcity(): ?string
    {
        return $this->birthcity;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setContry(string $contry): void
    {
        $this->contry = $contry;
    }

    public function getContry(): ?string
    {
        return $this->contry;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setEtablissement(string $etablissement): void
    {
        $this->etablissement = $etablissement;
    }

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function setUniversity(string $university): void
    {
        $this->university = $university;
    }

    public function getUniversity(): ?string
    {
        return $this->university;
    }

    public function setGsm(string $gsm): void
    {
        $this->gsm = $gsm;
    }

    public function getGsm(): ?string
    {
        return $this->gsm;
    }

    public function setCnss(string $cnss): void
    {
        $this->cnss = $cnss;
    }

    public function getCnss(): ?string
    {
        return $this->cnss;
    }

    public function setCnsstype(string $cnsstype): void
    {
        $this->cnsstype = $cnsstype;
    }

    public function getCnsstype(): ?string
    {
        return $this->cnsstype;
    }

    public function setParentName(string $parentName): void
    {
        $this->parentName = $parentName;
    }

    public function getParentName(): ?string
    {
        return $this->parentName;
    }

    public function setParentAddress(string $parentAddress): void
    {
        $this->parentAddress = $parentAddress;
    }

    public function getParentAddress(): ?string
    {
        return $this->parentAddress;
    }

    public function setParentGsm(string $parentGsm): void
    {
        $this->parentGsm = $parentGsm;
    }

    public function getParentGsm(): ?string
    {
        return $this->parentGsm;
    }

    public function setParentFixe(string $parentFixe): void
    {
        $this->parentFixe = $parentFixe;
    }

    public function getParentFixe(): ?string
    {
        return $this->parentFixe;
    }

    public function setResident(bool $resident): void
    {
        $this->resident = $resident;
    }

    public function getResident(): ?bool
    {
        return $this->resident;
    }

    public function addAntecedent(Antecedent $antecedents): void
    {
        $this->antecedents[] = $antecedents;
    }

    public function removeAntecedent(Antecedent $antecedents): void
    {
        $this->antecedents->removeElement($antecedents);
    }

    /**
     * @return Collection|Antecedent[]|null
     */
    public function getAntecedents(): ?Collection
    {
        return $this->antecedents;
    }

    public function addConsultation(Consultation $consultations): void
    {
        $this->consultations[] = $consultations;
    }

    public function removeConsultation(Consultation $consultations): void
    {
        $this->consultations->removeElement($consultations);
    }

    /**
     * @return Collection|Consultation[]|null
     */
    public function getConsultations(): ?Collection
    {
        return $this->consultations;
    }

    public function setIshandicap(bool $ishandicap): void
    {
        $this->ishandicap = $ishandicap;
    }

    public function getIshandicap(): bool
    {
        return $this->ishandicap;
    }

    public function setHandicap(string $handicap): void
    {
        $this->handicap = $handicap;
    }

    public function getHandicap(): ?string
    {
        return $this->handicap;
    }

    public function setNeeds(string $needs): void
    {
        $this->needs = $needs;
    }

    public function getNeeds(): ?string
    {
        return $this->needs;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }
}
