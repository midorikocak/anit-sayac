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

    function __construct()
    {
        $this->client = new Client();
    }
}