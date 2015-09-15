<?php

use SintegraPHP\MG\SintegraMG;
use Symfony\Component\DomCrawler\Crawler;

class SintegraMGTest extends PHPUnit_Framework_TestCase
{

    public function testGetParams() {

        $params = SintegraMG::getParams();

        $this->assertEquals(true, isset($params['captchaBase64']));
    }

    public function testParser(){

        $crawler = new Crawler();
        $crawler->addHtmlContent(file_get_contents(__DIR__.'/resposta.html'));

        $result = SintegraMG::parser($crawler);

        $this->assertEquals('07.399.636/0011-79', $result['cnpj']);
        $this->assertEquals('186348354.08-17', $result['inscricao_estadual']);
        $this->assertEquals('DECMINAS DISTRIBUICAO E LOGISTICA S.A.', $result['razao_social']);
        $this->assertEquals('4711-3/02 - Comércio varejista de mercadorias em geral, com predominância de produtos alimentícios - supermercados', $result['cnae_principal']);
        $this->assertEquals('20/03/2006', $result['data_inscricao']);
        $this->assertEquals('Não Habilitado - Baixado', $result['situacao']);
        $this->assertEquals('19/01/2015', $result['situacao_data']);
        $this->assertEquals('DEBITO E CREDITO', $result['regime_recolhimento']);
        $this->assertEquals('NÃO HABILITADO - INSCRIÇÃO ESTADUAL BAIXADA', $result['motivo_suspensao']);
    }

}