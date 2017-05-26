<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HistoryNote;
use AppBundle\Entity\LendeeHistory;
use AppBundle\Entity\Lender;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LenderController extends FOSRestController{

  /**
   * @Rest\Get("/api/lenders", name="lenders")
   */
  public function lendersAction(){
    $lenders = $this->getDoctrine()->getRepository('AppBundle:Lender')->findAll();

    if ($lenders === null){
      return new View('There are no Lenders at the moment', Response::HTTP_NOT_FOUND);
    }

    return $lenders;
  }
  /**
   * @Rest\Get("/api/lender/{id}", name="lender")
   */
  public function lenderAction($id, Request $request){
    $lenders = $this->getDoctrine()->getRepository('AppBundle:Lender')->find($id);

    if ($lenders === null){
      return new View('There is no Lender at the moment with ID '.$id, Response::HTTP_NOT_FOUND);
    }

    return $lenders;
  }
  /**
   * @Rest\Get("/api/demo/lender", name="demo_lender")
   */
  public function lenderDemoAction(){
    $lender = new Lender();
    $lender->setName('Bank of Africa');
    $em = $this->getDoctrine()->getManager();
    $em->persist($lender);
    $em->flush();

    return new View('Lender dummy data generated', Response::HTTP_OK);
  }
}