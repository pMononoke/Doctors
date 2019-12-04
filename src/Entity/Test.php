<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
{
    public static $GENERAL  = 'Examen Générale';

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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="string", length=255, nullable=true)
     */
    private $taille;

    /**
     * @var string
     *
     * @ORM\Column(name="poids", type="string", length=255, nullable=true)
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="ta", type="string", length=255, nullable=true)
     */
    private $ta;

    /**
     * @var string
     *
     * @ORM\Column(name="od", type="string", length=255, nullable=true)
     */
    private $od;

    /**
     * @var string
     *
     * @ORM\Column(name="og", type="string", length=255, nullable=true)
     */
    private $og;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hasvisualissue", type="boolean", nullable=true)
     */
    private $hasvisualissue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fixedvisualissue", length=255, nullable=true)
     */
    private $fixedvisualissue;

    /**
     * @var string
     *
     * @ORM\Column(name="request", type="text", nullable=true)
     */
    private $request;
    /**
     * @var string
     *
     * @ORM\Column(name="result", type="text", nullable=true)
     */
    private $result;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Consultation", inversedBy="tests")
    * @ORM\JoinColumn(name="consultation_id", referencedColumnName="id", nullable=false)
    */
    private $consultation;
    
    /************ constructeur ************/
    
    public function __construct()
    {
    }
    
    /************ getters & setters  ************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isGeneral(): ?bool
    {
        return ($this->type === Test::$GENERAL);
    }

    public function setConsultation(Consultation $consultation): void
    {
        $this->consultation = $consultation;
    }

    public function getConsultation(): ?Consultation
    {
        return $this->consultation;
    }

    public function setTaille(string $taille): void
    {
        $this->taille = $taille;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setPoids(string $poids): void
    {
        $this->poids = $poids;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setTa(string $ta): void
    {
        $this->ta = $ta;
    }

    public function getTa(): ?string
    {
        return $this->ta;
    }

    public function setOd(string $od): void
    {
        $this->od = $od;
    }

    public function getOd(): ?string
    {
        return $this->od;
    }

    public function setOg(string $og): void
    {
        $this->og = $og;
    }

    public function getOg(): ?string
    {
        return $this->og;
    }

    public function setRequest(string $request): void
    {
        $this->request = $request;
    }

    public function getRequest(): ?string
    {
        return $this->request;
    }

    public function setResult(string $result): void
    {
        $this->result = $result;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setHasvisualissue(bool $hasvisualissue): void
    {
        $this->hasvisualissue = $hasvisualissue;
    }

    public function getHasvisualissue(): ?bool
    {
        return $this->hasvisualissue;
    }

    public function setFixedvisualissue(bool $fixedvisualissue): void
    {
        $this->fixedvisualissue = $fixedvisualissue;
    }

    public function getFixedvisualissue(): ?bool
    {
        return $this->fixedvisualissue;
    }
}
