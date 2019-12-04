<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ConsultationMeds.
 *
 * @ORM\Table(name="consultation_meds")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ConsultationMeds
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
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consultation", inversedBy="consultationmeds")
     * @ORM\JoinColumn(name="consultation_id", referencedColumnName="id", nullable=false)
     * @var Consultation
     */
    protected $consultation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meds", inversedBy="consultationmeds")
     * @ORM\JoinColumn(name="meds_id", referencedColumnName="id", nullable=false)
     * @var Meds
     */
    protected $meds;

    /************ constructeur ************/

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
    }

    /************ getters & setters  ************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setConsultation(Consultation $consultation): void
    {
        $this->consultation = $consultation;
    }

    public function getConsultation(): ?Consultation
    {
        return $this->consultation;
    }

    public function setMeds(Meds $meds): void
    {
        $this->meds = $meds;
    }

    public function getMeds(): ?Meds
    {
        return $this->meds;
    }

    /**
     * @ORM\PreRemove()
     */
    public function updateMeds(): void
    {
        $this->meds->minusCount($this->count * (-1));
    }
}
