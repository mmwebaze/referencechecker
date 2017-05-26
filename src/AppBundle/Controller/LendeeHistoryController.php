<?php

namespace AppBundle\Controller;


use AppBundle\Entity\HistoryNote;
use AppBundle\Entity\LendeeHistory;
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
    $em = $this->getDoctrine()->getManager();
    $lendeeHistory = $em->getRepository('AppBundle:LendeeHistory')->findAll();

    if ($lendeeHistory === null){
      return new View('There is no Lendee history at the moment', Response::HTTP_NOT_FOUND);
    }
    //return new View('There is no History with ID '.$lendeeHistory[0]->getId(), Response::HTTP_OK);

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
  /**
   * @Rest\Post("/api/lendeeHistory", name="lendee_history_post")
   */
  public function addLendeeHistoryAction(Request $request){
    $data = json_decode($request->getContent(), true);
    $em = $this->getDoctrine()->getManager();
    $lendee = $em->getRepository('AppBundle:Lendee')->find($data['lendeeId']);
    $lender = $em->getRepository('AppBundle:Lender')->find($data['lenderId']);
    if (empty($lendee)) {
      return new View("Transaction can't be added without a valid Lendee", Response::HTTP_NOT_FOUND);
    }
    if (empty($lender)) {
      return new View("Transaction can't be added without a valid Lender", Response::HTTP_NOT_FOUND);
    }
    $lendeeHistory = new LendeeHistory();
    $lendeeHistory->setLendee($lendee);
    $lendeeHistory->setLoanStatusId($data['loanStatus']);
    $lendeeHistory->setOutstandingAmount($data['outstandingAmount']* rand(10,100));
    $lendeeHistory->setLastPaymentDate($data['lastPaymentDate']);
    $lendeeHistory->setLender($lender);

    $historyNote = new HistoryNote();
    $historyNote->setNote($data['historyNote'][0]);
    $historyNote->setLendeeHistory($lendeeHistory);//$lendeeHistoryNote->getLendeeHistory($lendeeHistory);
    //$lendeeHistory->addHistoryNotes($historyNote);


    //return new View(''.$lender->getName().' and ID '.$lender->getId(), Response::HTTP_OK);


    $em->persist($lendeeHistory);
    $em->persist($historyNote);
    $em->persist($lender);
    $em->flush();
    return new View("Transaction history for ".$lender->getName()." has been added on ".$data['lastPaymentDate'], Response::HTTP_OK);
  }
}