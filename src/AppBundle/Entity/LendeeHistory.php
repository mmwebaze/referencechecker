<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 */
class LendeeHistory {
  /**
   * @ORM\Id;
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  /**
   * @ORM\Column(type="integer")
   */
  private $loanStatusId;
  /**
   *
   * @ORM\ManyToOne(targetEntity="Lendee", inversedBy="id")
   * @ORM\JoinColumn(name="lendee_id", referencedColumnName="id", onDelete="CASCADE")
   */
  private $Lendee;
  /**
   * @ORM\Column(type="decimal",  precision=10, scale=2)
   */
  private $outstandingAmount;
  /**
   * @ORM\Column(type="date")
   */
  private $lastPaymentDate;
  /**
   * @ORM\OneToMany(targetEntity="HistoryNote", mappedBy="lendeeHistory")
   */
  private $historyNote;

  public function __construct() {
    $this->historyNote = new ArrayCollection();
  }

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
    $this->lastPaymentDate = new \DateTime($lastPaymentDate);
  }

  /**
   * @return mixed
   */
  public function getHistoryNote() {
    return $this->historyNote;
  }

  /**
   * @param mixed $historyNote
   */
  public function setHistoryNote(HistoryNote $historyNote) {
    $this->historyNote->add($historyNote);
  }

  public function getHistoryNotes(){
    return $this->historyNote->toArray();
  }
  public function addHistoryNotes(HistoryNote $historyNote){
    $this->historyNote->add($historyNote);
  }
}