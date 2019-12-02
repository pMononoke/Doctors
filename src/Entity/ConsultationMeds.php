<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConsultationMeds
 *
 * @ORM\Table(name="consultation_meds")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ConsultationMeds
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
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Consultation", inversedBy="consultationmeds")
    * @ORM\JoinColumn(name="consultation_id", referencedColumnName="id", nullable=false)
    */
    protected $consultation;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Meds", inversedBy="consultationmeds")
    * @ORM\JoinColumn(name="meds_id", referencedColumnName="id", nullable=false)
    */
    protected $meds;
    
    /************ constructeur ************/
    
    public function __construct()
    {
        $this->consultations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /************ getters & setters  ************/

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return Meds
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set consultation
     *
     * @param \App\Entity\Consultation $consultation
     * @return ConsultationMeds
     */
    public function setConsultation(\App\Entity\Consultation $consultation)
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * Get consultation
     *
     * @return \App\Entity\Consultation 
     */
    public function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * Set meds
     *
     * @param \App\Entity\Meds $meds
     * @return ConsultationMeds
     */
    public function setMeds(\App\Entity\Meds $meds)
    {
        $this->meds = $meds;

        return $this;
    }

    /**
     * Get meds
     *
     * @return \App\Entity\Meds 
     */
    public function getMeds()
    {
        return $this->meds;
    }

    /**
     * @ORM\PreRemove()
     */
    public function updateMeds()
    {
        $this->meds->minusCount($this->count * (-1));
    }
}
