<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity
 * ORM\@Table(name="users")
 * @UniqueEntity(fields={"username", "email"})
 */
class AppUser implements UserInterface {
  /**
   * @ORM\Id;
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  /**
   * @ORM\Column(type="string", length=255, unique=true)
   */
  protected $email;
  /**
   * @ORM\Column(type="string", length=40)
   */
  protected $username;
  /**
   * @ORM\Column(type="integer")
   */
  protected $roleId;
  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $password;
  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  protected $salt;

  /**
   * @return mixed
   */
  public function getSalt() {
    return $this->salt;
  }

  /**
   * @param mixed $salt
   */
  public function setSalt($salt) {
    $this->salt = $salt;
  }

  /**
   * @return mixed
   */
  public function getRoleId() {
    return $this->roleId;
  }

  /**
   * @param mixed $roleId
   */
  public function setRoleId($roleId) {
    $this->roleId = $roleId;
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
  public function getUsername() {
    return $this->username;
  }

  /**
   * @param mixed $username
   */
  public function setUsername($username) {
    $this->username = $username;
  }

  /**
   * @return mixed
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * @param mixed $password
   */
  public function setPassword($password) {
    $this->password = $password;
  }

  public function getRoles() {
    // TODO: Implement getRoles() method.
  }

  public function eraseCredentials() {
    // TODO: Implement eraseCredentials() method.
  }

}