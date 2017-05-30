<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Role;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends FOSRestController {
  /**
   * @Rest\Get("/api/roles", name="roles_get")
   */
  public function rolesAction(){
    $roles = $this->getDoctrine()->getRepository('AppBundle:Role')->findAll();

    if ($roles === null){
      return new View('There are no roles at the moment', Response::HTTP_NOT_FOUND);
    }

    return $roles;
  }
  /**
   * @Rest\Post("/api/role", name="role_post")
   */
  public function addRoleAction(Request $request){
    $data = json_decode($request->getContent(), true);
    $em = $this->getDoctrine()->getManager();
    foreach ($data['roles'] as $newRole){
      $role = new Role();
      $role->setRoleName($newRole);
      $em->persist($role);
    }
    $em->flush();
  }
}