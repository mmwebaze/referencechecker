<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AppUser;
use AppBundle\Entity\Role;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class UserController extends FOSRestController{

  /**
   * @Rest\Get("/api/users", name="users_get")
   */
  public function usersAction(){
    $users = $this->getDoctrine()->getRepository('AppBundle:AppUser')->findAll();

    if ($users === null){
      return new View('There are no users at the moment', Response::HTTP_NOT_FOUND);
    }

    return $users;
  }
  /**
   * @Rest\Post("/api/user", name="user_post")
   */
  public function addUserAction(Request $request){
    $data = json_decode($request->getContent(), true);
    $encoder = $this->container->get('security.password_encoder');
    foreach ($data['users'] as $key => $newUser){
      $user = new AppUser();
      $encoded = $encoder->encodePassword($user, $newUser['password']);
      $user->setUsername($newUser['username']);
      $user->setPassword($encoded);
      $user->setEmail($newUser['email']);
      $em = $this->getDoctrine()->getManager();
      foreach ($newUser['roles'] as $configuredRole){
        $role = $em->getRepository('AppBundle:Role')->find($configuredRole);
        $user->setRoles($role);
        /*$role = new Role();
        $role->setRoleName($configuredRole);
        $user->setRoles($role);*/
        //$em->persist($role);
      }
      $em->persist($user);
      $em->flush();
    }


    return new View('User has been added ', Response::HTTP_OK);
  }
}