<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity
 * @UniqueEntity(fields={"roleName"})
 */
class Role {
  /**
   * @ORM\Id;
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  /**
   * @ORM\Column(type="string", length=64)
   */
  protected $roleName;
  /**
   *
   *
   */
  protected $appUser;

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getRoleName() {
    return $this->roleName;
  }

  /**
   * @param mixed $roleName
   */
  public function setRoleName($roleName) {
    $this->roleName = $roleName;
  }
}