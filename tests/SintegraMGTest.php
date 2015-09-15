<?php

use SintegraPHP\MG\SintegraMG;
use Symfony\Component\DomCrawler\Crawler;

class SintegraMGTest extends PHPUnit_Framework_TestCase
{

    public function testGetParams() {

        $params = SintegraMG::getParams();

        $this->assertEquals(true, isset($params['captchaBase64']));
        $this->assertEquals(true, isset($params['challenge']));
    }

    public function testParser(){

        $crawler = new Crawler();
        $crawler->addHtmlContent(file_get_contents(__DIR__.'/resposta.html'));

        $result = SintegraMG::parser($crawler);

        //Dados da empresa
        $this->assertEquals('07.399.636/0011-79', $result['cnpj']);
        $this->assertEquals('186348354.08-17', $result['inscricao_estadual']);
        $this->assertEquals('DECMINAS DISTRIBUICAO E LOGISTICA S.A.', $result['razao_social']);
        $this->assertEquals('4711-3/02 - Comércio varejista de mercadorias em geral, com predominância de produtos alimentícios - supermercados', $result['cnae_principal']);
        $this->assertEquals('20/03/2006', $result['data_inscricao']);
        $this->assertEquals('Não Habilitado - Baixado', $result['situacao']);
        $this->assertEquals('19/01/2015', $result['situacao_data']);
        $this->assertEquals('DEBITO E CREDITO', $result['regime_recolhimento']);
        $this->assertEquals('NÃO HABILITADO - INSCRIÇÃO ESTADUAL BAIXADA', $result['motivo_suspensao']);
        $this->assertEquals('', $result['telefone']);

        //Endereco
        $this->assertEquals('30662050', $result['endereco']['cep']);
        $this->assertEquals('RUA ANTONIO EUSTAQUIO PIAZZA', $result['endereco']['logradouro']);
        $this->assertEquals('2725', $result['endereco']['numero']);
        $this->assertEquals('', $result['endereco']['complemento']);
        $this->assertEquals('TIROL', $result['endereco']['bairro']);
        $this->assertEquals('BELO HORIZONTE', $result['endereco']['cidade']);
        $this->assertEquals('', $result['endereco']['distrito']);
        $this->assertEquals('MG', $result['endereco']['uf']);

    }

}