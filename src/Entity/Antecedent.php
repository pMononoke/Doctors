<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Antecedent.
 *
 * @ORM\Table(name="antecedent")
 * @ORM\Entity(repositoryClass="App\Entity\AntecedentRepository")
 */
class Antecedent
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
     * @ORM\Column(name="allergies", type="text", nullable=true)
     */
    private $allergies;

    /**
     * @var string
     *
     * @ORM\Column(name="autres", type="text", nullable=true)
     */
    private $autres;

    /**
     * @var string
     *
     * @ORM\Column(name="traitement", type="text", nullable=true)
     */
    private $traitement;

    /**
     * @var string
     *
     * @ORM\Column(name="chirurgicaux", type="text", nullable=true)
     */
    private $chirurgicaux;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="antecedents")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=false)
     */
    private $person;

    /************ constructeur ************/

    public function __construct()
    {
    }

    /************ getters & setters  ************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setAllergies(string $allergies): void
    {
        $this->allergies = $allergies;
    }

    public function getAllergies(): string
    {
        return $this->allergies;
    }

    public function setAutres(string $autres): void
    {
        $this->autres = $autres;
    }

    public function getAutres(): string
    {
        return $this->autres;
    }

    public function setTraitement(string $traitement): void
    {
        $this->traitement = $traitement;
    }

    public function getTraitement(): string
    {
        return $this->traitement;
    }

    public function setChirurgicaux(string $chirurgicaux): void
    {
        $this->chirurgicaux = $chirurgicaux;
    }

    public function getChirurgicaux(): string
    {
        return $this->chirurgicaux;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }
}
