<?php

use SintegraPHP\MG\SintegraMG;
use Symfony\Component\DomCrawler\Crawler;

class SintegraMGTest extends PHPUnit_Framework_TestCase
{

    public function testGetParams() {

        //$params = SintegraMG::getParams();

        //$this->assertEquals(true, isset($params['captchaBase64']));

    }

    public function testParser(){
        $crawler = new Crawler();
        $crawler->addHtmlContent(file_get_contents(__DIR__.'/resposta.html'));

        $result = SintegraMG::parser($crawler);

        var_dump($result);
    }

}