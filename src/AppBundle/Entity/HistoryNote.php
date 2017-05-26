<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */
class HistoryNote {
  /**
   * @ORM\Id;
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  /**
   * @ORM\Column(type="text")
   */
  private $note;
  /**
   *
   * @ORM\ManyToOne(targetEntity="LendeeHistory", inversedBy="historyNote")
   * @ORM\JoinColumn(name="Lendee_history_id", referencedColumnName="id", nullable=FALSE)
   */
  private $lendeeHistory;

  /**
   * @return mixed
   */
  public function getLendeeHistory() {
    return $this->lendeeHistory;
  }

  /**
   * @param mixed $lendeeHistory
   */
  public function setLendeeHistory(LendeeHistory $lendeeHistory) {
    $this->lendeeHistory = $lendeeHistory;
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
  public function getNote() {
    return $this->note;
  }

  /**
   * @param mixed $note
   */
  public function setNote($note) {
    $this->note = $note;
  }

}