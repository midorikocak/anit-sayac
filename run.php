<?php
    include('vendor/autoload.php');
    $crawl = new \MidoriKocak\Crawler();
    $namesJson = file_get_contents('data/names.json');
    $names = json_decode($namesJson, true);
    $result = [];
    $notFetched = [];
    foreach($names as $key => $value){
        usleep(2000000);
        if(!file_exists('data/'.$key.'.json')){
            $person = $crawl->getPerson($value['link']);
            $crawl->saveArrayToJson($person,$key);
            var_dump($person);
        }
    }
?>