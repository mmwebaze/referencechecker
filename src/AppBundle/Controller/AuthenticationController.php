<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends FOSRestController{

  /**
   * @Rest\Get("/api/token-authentication", name="token_authentication")
   */
  public function tokenAuthentication(Request $request){
   /* $credentials = json_decode($request->getContent(), true);
    $username = $credentials['username'];
    $password = $credentials['password'];*/
    $username = $request->getUser();
    $password = $request->getPassword();

    $user = $this->getDoctrine()->getRepository('AppBundle:AppUser')
      ->findOneBy(['username' => $username]);

    if(!$user) {
      throw $this->createNotFoundException();
    }
    $secret = $this->get('security.password_encoder')->encodePassword($user, $password);

    //$passwordIsValid = $this->get('security.password_encoder')->isPasswordValid($user, $password);
    // password check
    if(!$this->get('security.password_encoder')->isPasswordValid($user, $password)) {
      throw $this->createAccessDeniedException();
    }
    //dump($passwordIsValid);


    $token = $this->get('lexik_jwt_authentication.encoder')
      ->encode(['username' => $user->getUsername()]);

    //return new View("Authentication valid ".$username.' password '.$password.' salt'.$user->getSalt(), Response::HTTP_OK);
    return ['token' => $token];
  }

}