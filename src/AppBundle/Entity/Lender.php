<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 *
 */
class Lender {
  /**
   * @ORM\Id;
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   *
   */
  private $id;
  /**
   * @ORM\Column(type="string", length=40)
   */
  private $name;
  /**
   * @ORM\OneToMany(targetEntity="LendeeHistory", mappedBy="Lender")
   */
  private $LendeeHistory;
  /**
   *  @ORM\Column(type="string", length=15, unique=true, nullable=FALSE)
   */
  private $bankCode;

  /**
   * @return mixed
   */
  public function getBankCode() {
    return $this->bankCode;
  }

  /**
   * @param mixed $bankCode
   */
  public function setBankCode($bankCode) {
    $this->bankCode = $bankCode;
  }

  /**
   * @return mixed
   */
  public function getLendeeHistory() {
    return $this->LendeeHistory;
  }

  /**
   * @param mixed $LendeeHistroy
   */
  public function setLendeeHistroy($LendeeHistory) {
    $this->LendeeHistory = LendeeHistory;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name) {
    $this->name = $name;
  }

}