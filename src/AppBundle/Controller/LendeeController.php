<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lendee;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LendeeController extends FOSRestController {
  /**
   * @Rest\Get("/api/lendees", name="lendees_get")
   */
  public function lendeesAction()
  {
    $lendees = $this->getDoctrine()->getRepository('AppBundle:Lendee')->findAll();

    if ($lendees === null){
      return new View('There are no Lendees at the moment', Response::HTTP_NOT_FOUND);
    }

    return $lendees;
  }
  /**
   * @Rest\Post("/api/lendee", name="lendee_post")
   */
  public function addLendeeAction(Request $request){
    $data = json_decode($request->getContent(), true);

    $rand = rand(10,100000);
    $lendee = new Lendee();
    $lendee->setFirstName($data['firstname'].$rand);
    $lendee->setLastName($data['lastname'].$rand);
    $lendee->setPhone($data['phone'].$rand);
    $lendee->setEmail($data['email'].$rand.'@gmail.com');
    $lendee->setIdentificationNumber($data['ID'].$rand);
    $em = $this->getDoctrine()->getManager();
    $em->persist($lendee);
    $em->flush();
    //dump($lendee);
    return new View("Lendee ".$data['firstname']." ".$data['lastname']." Added Successfully", Response::HTTP_OK);
  }
  /**
   * @Rest\Put("/api/lendee/{id}", name="lendee_put")
   */
  public function updateLendeeAction($id, Request $request) {
    $data = json_decode($request->getContent(), true);
    $updateLendee = new Lendee();
    $em = $this->getDoctrine()->getManager();
    $lendee = $this->getDoctrine()->getRepository('AppBundle:Lendee')->find($id);
    if (empty($lendee)) {
      return new View("Lendee with ID ".$id." not found", Response::HTTP_NOT_FOUND);
    }
    else{
      $rand = rand(10,100000);
      $lendee->setFirstName($data['firstname'].$rand);
      $lendee->setLastName($data['lastname'].$rand);
      $lendee->setPhone($data['phone'].$rand);
      $lendee->setEmail($data['email'].$rand.'@gmail.com');
      $lendee->setIdentificationNumber($data['ID'].$rand);
      $em->flush();
      return new View("Lendee ".$data['firstname']." ".$data['lastname']." Updated Successfully", Response::HTTP_OK);
    }
  }
}