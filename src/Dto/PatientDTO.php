<?php

declare(strict_types=1);

namespace App\Dto;

class PatientDTO
{
    /** @var int */
    public $id;

    /** @var string */
    public $firstName;

    /** @var string */
    public $lastName;
    /** @var \DateTime */
    public $dateOfBirthday;

    /** @var string */
    public $cin;

    /** @var string */
    public $cne;

    /** @var string */
    public $email;

    /** @var \DateTime */
    public $birthday;

    /** @var string */
    public $birthcity;

    /** @var string */
    public $gender;

    /** @var string */
    public $contry;

    /** @var string */
    public $city;

    /** @var string */
    public $address;

    /** @var string */
    public $etablissement;

    /** @var string */
    public $university;

    /** @var string */
    public $gsm;

    /** @var string */
    public $cnss;

    /** @var string */
    public $cnsstype;

    /** @var string */
    public $parentName;

    /** @var string */
    public $parentAddress;

    /** @var string */
    public $parentGsm;

    /** @var string */
    public $parentFixe;

    public $ishandicap;

    public $handicap;

    public $needs;

    /** @var bool */
    public $resident;

    /** @var \DateTime */
    public $created;
}
