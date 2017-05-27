<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HistoryNote;
use AppBundle\Entity\LendeeHistory;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Finder;

class DummyDataController extends FOSRestController{
  /**
   * @Rest\Get("/api/dummydata", name="dummy_data")
   */
  public function dummyDataAction(){
    $base_url = 'http://127.0.0.1:8000';
    $file_url_mapping = ['Lendees.json' => $base_url.'/api/lendee'];
    $dummyDataFolder = [];

    $client = new \GuzzleHttp\Client();

    $path = $this->container->get('app.refcheck');
    $finder = new Finder();
    $finder->files()->in($path->getRootDir());
    foreach ($finder as $file) {
      $dummyDataFolder[$file_url_mapping[$file->getRelativePathname()]] = $file->getContents();
    }
    foreach ($dummyDataFolder as $url => $data){
      $response = $client->request('POST', $url,
        ['json' => json_decode($data)]
      );
    }

    //return new View('Dummy Data has been generated ', Response::HTTP_OK);
    return $dummyDataFolder;
  }
}