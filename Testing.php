<?php
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/AppBundle/Service/RefCheckService.php';
$base_url = 'http://localhost:8000/api';
$file_url_mapping = [
  'lendee.json' => $base_url.'/lendee',
  'lender.json' => $base_url.'/lender',
  'lendeeHistory.json' => $base_url.'/lendeeHistory',
  'role.json' => $base_url.'/role',
  'user.json' => $base_url.'/user'
];
$dummyDataFolder = [];

$client = new \GuzzleHttp\Client([
  'defaults' => [
    'exceptions' => false
  ]
]);
$path = new \AppBundle\Service\RefCheckService();

$finder = new \Symfony\Component\Finder\Finder();
$finder->files()->in($path->getRootDir());
foreach ($finder as $file) {
  //$dummyDataFolder[$file_url_mapping[$file->getRelativePathname()]] = $file->getContents();
  $dummyDataFolder[$file->getRelativePathname()] = $file->getContents();
}

foreach ($file_url_mapping as $file => $url){
  $response = $client->post($url,[
    'body' => $dummyDataFolder[$file]
  ]);
  echo json_encode($response->getBody());
}

//echo $response;