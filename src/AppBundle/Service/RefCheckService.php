<?php

namespace AppBundle\Service;

class RefCheckService {
  public function getRootDir(){

    $cwd = getcwd();
    $projectRoot = chdir('dummydata');
    $cwd = getcwd();
    return $cwd;
  }
  public function __toString() {
    return "Returns dummydata folder from project root";
  }
}