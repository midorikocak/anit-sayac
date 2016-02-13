<?php

namespace MidoriKocak;
use Goutte\Client;


/**
 * Class Crawler
 *
 * First Run
 * Check if there is not a data.json.
 *
 * 1. Connect to anitsayac.com
 * 2. Get all names and links into an array 'name'=>'link'
 * 3. Go to link.
 * 4. find key value pairs.
 * 5. add to array.
 * 6. Save array to json.
 *
 * Full Update
 * If there is data.json
 * 1. Connect to anitsayac.com
 * 2. Get all names and links into an array 'name'=>'link'
 * 3. Go to link
 * 4. Find key value pairs. compare with saved data.
 * 5. Save if different
 *
 * Lazy Update
 * If there is data.json
 * 1. Connect to anitsayac.com
 * 2. Get all names and links into an array.
 * 4. Compare with data.json
 * 5. if new, go to link
 * 6. Find key value pairs.
 * 7. append array to json.
 *
 * @package MidoriKocak
 */
class Crawler {

    private $client;
    private $crawler;

    function __construct()
    {
        $this->client = new Client();
    }

    function connect(){
        $this->crawler = $this->client->request('GET', 'http://www.anitsayac.com/');
    }

    public function getNames(){
            $names = $this->crawler->filter('span.xxy > a')->each(function ($node) {
                return ['id'=>filter_var($node->attr('href'), FILTER_SANITIZE_NUMBER_INT),'name'=> $node->text(), 'link'=> 'http://www.anitsayac.com/'.$node->attr('href')];
            });
            $this->saveArrayToJson($names,'names');
        return true;
    }

    function getPerson($url){
        $result = [];
        $personCrawler = $this->client->request('GET', $url);
        $images = $personCrawler->filter('img')->each(function ($node) {
            return $node->attr('src');
        });

        $body = $personCrawler->filter('body')->each(function ($node) {
            return explode('<br>',$node->html());
        });
        $lastElementKey = null;
        if(!isset($body[0])){
            return null;
        }
            foreach ($body[0] as $value){
                $value = strip_tags($value);
                if(strpos($value,':')!==false){
                    $data = explode(':',$value);
                    if(sizeof($data)>2){
                        $data[1] .= $data[2];
                    }
                    $data[0] = $string = trim(preg_replace('/\s\s+/', ' ', $data[0]));
                    $result[$data[0]] = trim($data[1]);
                    $lastElementKey = $data[0];
                }
                else{
                    $result[$lastElementKey] .= ' '.$value;
                }
            }
        $result['images'] = $images;
        return $result;
    }

    function saveArrayToJson(Array $array, String $name){
        $encodedString = json_encode($array);
        file_put_contents('data/'.$name.'.json', $encodedString);
    }

    function appendArrayToJson(Array $array, String $name){
        $fileContents = file_get_contents('../data/'.$name.'.json');
        $decoded = json_decode($fileContents, true);
        $newArray = array_merge($decoded,$array);
        file_put_contents('../data/'.$name.'.json', $newArray);
    }
}