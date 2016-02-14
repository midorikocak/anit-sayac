<?php
/**
 * Created by PhpStorm.
 * User: mtkocak
 * Date: 14/02/16
 * Time: 12:11
 */

include('vendor/autoload.php');
$namesJson = file_get_contents('data/names.json');
$names = json_decode($namesJson, true);
$result = [];
foreach($names as $key => $value){
    if(file_exists('data/'.$key.'.json')){
        $personJson = file_get_contents('data/'.$key.'.json');
        $person = json_decode($personJson, true);
        $result[$key] = array_merge($value,$person);
        var_dump($key);
    }
    $jsonData = json_encode($result);
    file_put_contents('data/data.json',$jsonData);
}