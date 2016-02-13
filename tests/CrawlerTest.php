<?php

use MidoriKocak\Crawler;

class CrawlerTest extends \PHPUnit_Framework_TestCase {

    public $crawler;

    public function setup()
    {
        $this->crawler = new Crawler();
        $this->crawler->connect();
    }

    public function testGetNames(){
        $this->crawler->getDetails();
    }
} 