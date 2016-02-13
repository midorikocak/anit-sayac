<?php
    include('vendor/autoload.php');
    $crawl = new \MidoriKocak\Crawler();
    $namesJson = file_get_contents('data/names.json');
    $names = json_decode($namesJson, true);
    $result = [];
    $notFetched = [];
    foreach($names as $key => $value){
        usleep(2000000);
        $person = $crawl->getPerson($value['link']);
        if(!file_exists('data/'.$key.'.json')){
            $crawl->saveArrayToJson($person,$key);
        }
    }
?>