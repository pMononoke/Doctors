<?php

namespace App\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
////////////// * @ORM\Entity(repositoryClass="UserRepository"))
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks
 */
class User {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $family_name
     *
     * @ORM\Column(name="family_name", type="string", length=255, nullable=true)
     */
    private $family_name;

    /**
     * @var string $first_name
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $first_name;

    /**
     * @var string $tel
     *
     * @ORM\Column(name="tel", type="string", length=45, nullable=true)
     */
    private $tel;

//TODO Gedmo * @Gedmo\Timestampable(on="create")
    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created", type="datetime")

     */
    protected $created;


//TODO Gedmo * @Gedmo\Timestampable(on="create")
    /**
     * @var \DateTime $lastActivity
     *
     * @ORM\Column(name="lastActivity", type="datetime")
     */
    protected $lastActivity;
    
    /**
    * @ORM\OneToOne(targetEntity="App\Entity\image", cascade={"remove", "persist"})
    */
    private $image;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Consultation", mappedBy="user", cascade={"remove", "persist"})
    */
    protected $consultations;

    
    /************ constructeur ************/
    
    public function __construct()
    {
        parent::__construct();
        $this->created = new \DateTime;
        $this->lastActivity = new \DateTime;
        $this->image= new \App\Entity\image();
        $this->consultations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /************ getters & setters  ************/

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->family_name.' '.$this->first_name;
    }

    /**
     * Set family_name
     *
     * @param string $familyName
     * @return profile
     */
    public function setFamilyName($familyName)
    {
        $this->family_name = $familyName;
    
        return $this;
    }

    /**
     * Get family_name
     *
     * @return string 
     */
    public function getFamilyName()
    {
        return $this->family_name;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return profile
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return profile
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return User
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set lastActivity
     *
     * @param \DateTime $lastActivity
     * @return User
     */
    public function setLastActivity($lastActivity) {
        $this->lastActivity = $lastActivity;

        return $this;
    }

    /**
     * Get lastActivity
     *
     * @return \DateTime 
     */
    public function getLastActivity() {
        return $this->lastActivity;
    }

    /**
     * Set lastActivity
     *
     * @param \DateTime $lastActivity
     * @return User
     */
    public function isActiveNow() {
        $this->lastActivity = new \DateTime();

        return $this;
    }

    /**
     * Set image
     *
     * @param \App\Entity\image $image
     * @return profile
     */
    public function setImage(\App\Entity\image $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \App\Entity\image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar() {

        return $this->image->getWebPath();
    }

    /**
     * Get the most significant role
     *
     * @return string 
     */
    public function getRole()
    {
        if(in_array('ROLE_ADMIN', $this->roles)) $role = 'Administrateur';
        else if(in_array('ROLE_MANAGER', $this->roles)) $role = 'Manager';
        else $role = 'utilisateur';
        return $role;
    }


    /**
     * Add consultations
     *
     * @param \App\Entity\Consultation $consultations
     * @return User
     */
    public function addConsultation(\App\Entity\Consultation $consultations)
    {
        $this->consultations[] = $consultations;

        return $this;
    }

    /**
     * Remove consultations
     *
     * @param \App\Entity\Consultation $consultations
     */
    public function removeConsultation(\App\Entity\Consultation $consultations)
    {
        $this->consultations->removeElement($consultations);
    }

    /**
     * Get consultations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConsultations()
    {
        return $this->consultations;
    }
}

?>
