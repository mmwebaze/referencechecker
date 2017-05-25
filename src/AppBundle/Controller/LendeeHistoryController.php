<?php

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LendeeHistoryController  extends FOSRestController {
  /**
   * @Rest\Get("/api/lendeeHistory", name="lendees_history")
   */
  public function lendeesHistoryAction(){
    $lendeeHistory = $this->getDoctrine()->getRepository('AppBundle:LendeeHistory')->findAll();

    if ($lendeeHistory === null){
      return new View('There is no Lendee history at the moment', Response::HTTP_NOT_FOUND);
    }

    return $lendeeHistory;
  }
  /**
   * @Rest\Get("/api/lendeeHistory/{id}", name="lendee_history")
   */
  public function lendeeHistoryAction($id){
    $lendeeHistory = $this->getDoctrine()->getRepository('AppBundle:LendeeHistory')->find($id);

    if ($lendeeHistory === null){
      return new View('There is no History with ID '.$id, Response::HTTP_NOT_FOUND);
    }

    return $lendeeHistory;
  }
}