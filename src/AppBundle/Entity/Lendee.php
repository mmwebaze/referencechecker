<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity
 * @UniqueEntity(fields={"email", "identificationNumber"})
 */
class Lendee {
  /**
   * @ORM\Id;
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\OneToMany(targetEntity="LendeeHistory", mappedBy="$lendeeId")
   */
  protected $id;
  /**
   * @ORM\Column(type="string", length=40)
   */
  protected $firstName;
  /**
   * @ORM\Column(type="string", length=40)
   */
  protected $lastName;
  /**
   * @ORM\Column(type="string", length=40)
   */
  protected $phone;
  /**
   * @ORM\Column(type="string", length=255, unique=true)
   */
  protected $email;
  /**
   * @ORM\Column(type="bigint", unique=true)
   */
  protected $identificationNumber;

  /**
   * @return mixed
   */
  public function getFirstName() {
    return $this->firstName;
  }

  /**
   * @param mixed $firstName
   */
  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  /**
   * @return mixed
   */
  public function getLastName() {
    return $this->lastName;
  }

  /**
   * @param mixed $lastName
   */
  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  /**
   * @return mixed
   */
  public function getPhone() {
    return $this->phone;
  }

  /**
   * @param mixed $phone
   */
  public function setPhone($phone) {
    $this->phone = $phone;
  }

  /**
   * @return mixed
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email) {
    $this->email = $email;
  }

  /**
   * @return mixed
   */
  public function getIdentificationNumber() {
    return $this->identificationNumber;
  }

  /**
   * @param mixed $identificationNumber
   */
  public function setIdentificationNumber($identificationNumber) {
    $this->identificationNumber = $identificationNumber;
  }

  /**
   * @param mixed $id
   */
  public function setId($id) {
    $this->id = $id;
  }
}