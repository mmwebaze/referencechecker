<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */
class LendeeHistory {
  /**
   * @ORM\Id;
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  /**
   * @ORM\Column(type="integer")
   */
  protected $loanStatusId;
  /**
   *
   * @ORM\ManyToOne(targetEntity="Lendee", inversedBy="id")
   * @ORM\JoinColumn(onDelete="CASCADE")
   */
  protected $Lendee;
  /**
   * @ORM\Column(type="decimal",  precision=10, scale=2)
   */
  protected $outstandingAmount;
  /**
   * @ORM\Column(type="date")
   */
  protected $lastPaymentDate;

  /**
   * @return mixed
   */
  public function getLendee() {
    return $this->Lendee;
  }

  /**
   * @param mixed $Lendee
   */
  public function setLendee(Lendee $Lendee) {
    $this->Lendee = $Lendee;
  }


  /**
   * @return mixed
   */
  public function getOutstandingAmount() {
    return $this->outstandingAmount;
  }

  /**
   * @param mixed $outstandingAmount
   */
  public function setOutstandingAmount($outstandingAmount) {
    $this->outstandingAmount = $outstandingAmount;
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
  public function getLoanStatusId() {
    return $this->loanStatusId;
  }

  /**
   * @param mixed $loanStatusId
   */
  public function setLoanStatusId($loanStatusId) {
    $this->loanStatusId = $loanStatusId;
  }

  /**
   * @return mixed
   */
  public function getLastPaymentDate() {
    return $this->lastPaymentDate;
  }

  /**
   * @param mixed $lastPaymentDate
   */
  public function setLastPaymentDate($lastPaymentDate) {
    $this->lastPaymentDate = $lastPaymentDate;
  }

}