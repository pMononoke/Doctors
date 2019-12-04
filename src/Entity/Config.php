<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config.
 *
 * @ORM\Table(name="config")
 * @ORM\Entity(repositoryClass="App\Entity\ConfigRepository")
 */
class Config
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
     * @ORM\Column(name="the_key", type="string", length=255)
     */
    private $theKey;

    /**
     * @var string
     *
     * @ORM\Column(name="the_value", type="text")
     */
    private $theValue;

    public function __construct($the_key = '', $the_value = '')
    {
        $this->the_key = $the_key;
        $this->the_value = $the_value;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTheKey(string $theKey): void
    {
        $this->theKey = $theKey;
    }

    public function getTheKey(): ?string
    {
        return $this->theKey;
    }

    public function setTheValue(string $theValue): void
    {
        $this->theValue = $theValue;
    }

    public function getTheValue(): ?string
    {
        return $this->theValue;
    }
}
