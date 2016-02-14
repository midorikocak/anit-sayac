<?php
    include('vendor/autoload.php');
    $crawl = new \MidoriKocak\Crawler();
    $namesJson = file_get_contents('data/names.json');
    $names = json_decode($namesJson, true);
    $result = [];
    $notFetched = [];
    foreach($names as $key => $value){
        trial:
        if(!file_exists('data/'.$key.'.json')){
            if($crawl->getPerson($value['link'])!=null){
                $person = $crawl->getPerson($value['link']);
                $crawl->saveArrayToJson($person,$key);
                var_dump($person);
                usleep(2000000);
            }
            else{
                echo "waiting";
                usleep(60000000);
                goto trial;
            }
        }
    }
?>