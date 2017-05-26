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
  /**
   * @Rest\Post("/api/lendeeHistory", name="lendee_history_post")
   */
  public function addLendeeHistoryAction(Request $request){
    $data = json_decode($request->getContent(), true);
    $lendee = $this->getDoctrine()->getRepository('AppBundle:Lendee')->find($data['lendeeId']);
    if (empty($lendee)) {
      return new View("Transaction can't be added without a valide Lendee", Response::HTTP_NOT_FOUND);
    }
    $lendeeHistory = new LendeeHistory();
    $lendeeHistory->setLendee($lendee);
    $lendeeHistory->setLoanStatusId($data['loanStatus']);
    $lendeeHistory->setOutstandingAmount($data['outstandingAmount']* rand(10,100));
    $lendeeHistory->setLastPaymentDate($data['lastPaymentDate']);

    $historyNote = new HistoryNote();
    $historyNote->setNote($data['historyNote'][0]);
    //$lendeeHistoryNote->getLendeeHistory($lendeeHistory);
    $lendeeHistory->addHistoryNotes($historyNote);
    //return new View(''.$data['historyNote'][0], Response::HTTP_OK);

    $em = $this->getDoctrine()->getManager();
    $em->persist($lendeeHistory);
    $em->persist($historyNote);
    $em->flush();
    return new View("Transaction history for ".$lendeeHistory->getId()." has been added on ".$data['lastPaymentDate'], Response::HTTP_OK);
  }
}