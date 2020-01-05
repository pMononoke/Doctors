<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metadata.
 *
 * @ORM\Table(name="metadata")
 * @ORM\Entity(repositoryClass="App\Repository\MetadataRepository")
 */
class Metadata
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
     * @ORM\Column(name="thekey", type="string", length=255)
     */
    private $thekey;

    /**
     * @var string
     *
     * @ORM\Column(name="thevalue", type="string", length=255)
     */
    private $thevalue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Test", inversedBy="metadata")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id", nullable=false)
     *
     * @var Test
     */
    private $test;

    /************ constructeur ************/

    public function __construct()
    {
    }

    /************ getters & setters  ************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setThekey(string $thekey): void
    {
        $this->thekey = $thekey;
    }

    public function getThekey(): ?string
    {
        return $this->thekey;
    }

    public function setThevalue(string $thevalue): void
    {
        $this->thevalue = $thevalue;
    }

    public function getThevalue(): ?string
    {
        return $this->thevalue;
    }

    public function setTest(Test $test): void
    {
        $this->test = $test;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }
}
