<?php
namespace AppBundle\Security;

use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class JwtAuthenticator extends AbstractGuardAuthenticator {
  private $em;
  private $jwtEncoder;
  public function __construct(EntityManager $em, JWTEncoderInterface $jwtEncoder){
    $this->em = $em;
    $this->jwtEncoder = $jwtEncoder;
  }
  public function getCredentials(\Symfony\Component\HttpFoundation\Request $request) {

    if(!$request->headers->has('Authorization')) {
      return;
    }

    $extractor = new AuthorizationHeaderTokenExtractor(
      'Bearer',
      'Authorization'
    );

    $token = $extractor->extract($request);

    if(!$token) {
      return;
    }

    return $token;
  }

  public function getUser($credentials, UserProviderInterface $userProvider) {
    $data = $this->jwtEncoder->decode($credentials);

    if(!$data){
      return;
    }

    $username = $data['username'];

    $user = $this->em->getRepository('AppBundle:AppUser')
      ->findOneBy(['username' => $username]);

    if(!$user){
      return;
    }

    return $user;
  }

  public function checkCredentials($credentials, UserInterface $user) {
    return true;
  }

  public function onAuthenticationFailure(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\Security\Core\Exception\AuthenticationException $exception) {
    return new \Symfony\Component\HttpFoundation\JsonResponse([
      'message' => $exception->getMessage()
    ], 401);
  }

  public function onAuthenticationSuccess(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token, $providerKey) {
    return;
  }

  public function supportsRememberMe() {
    return false;
  }

  public function start(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\Security\Core\Exception\AuthenticationException $authException = null) {

    return new \Symfony\Component\HttpFoundation\JsonResponse('Auth header required', 401);
  }

}