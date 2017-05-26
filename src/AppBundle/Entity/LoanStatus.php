<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class LoanStatus {
  /**
   * @ORM\Id;
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  /**
   * @ORM\Column(type="string", length=40)
   */
  private $status;

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getStatus() {
    return $this->status;
  }

  /**
   * @param mixed $status
   */
  public function setStatus($status) {
    $this->status = $status;
  }

}