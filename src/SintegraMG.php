<?php

namespace SintegraPHP\MG;

use Exception;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class SintegraMG
{

    /**
     * Metodo para capturar o captcha para enviar no método de consulta
     *
     * @throws Exception
     * @return array Captcha
     */
    public static function getParams() {

        $client = new Client();
        $crawler = $client->request('GET', 'http://consultasintegra.fazenda.mg.gov.br/sintegra');

        $urlGoogle = $crawler->filter('#captcha > script')->attr('src');

        $ch = curl_init($urlGoogle);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_BINARYTRANSFER => TRUE
        );
        curl_setopt_array($ch, $options);
        $js = curl_exec($ch);
        curl_close($ch);

        preg_match("/challenge : '.+/", $js, $matches);

        if(count($matches)>0){
            $c = str_replace(array("\r", "\n"), "", $matches[0]);
            $c = str_replace("challenge : '", "", $c);
            $c = str_replace("',", "", $c);

            $ch = curl_init('https://www.google.com/recaptcha/api/image?c='.$c);
            $options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_BINARYTRANSFER => TRUE
            );
            curl_setopt_array($ch, $options);
            $img = curl_exec($ch);
            curl_close($ch);

            if(@imagecreatefromstring($img)==false)
                throw new Exception('Não foi possível capturar o captcha');

            return array(
                'captchaBase64' => 'data:image/png;base64,' . base64_encode($img),
                'challenge' => $c
            );
        }
    }

    /**
     * Metodo para realizar a consulta
     *
     * @param  string $cnpj CNPJ
     * @param  string $captcha CAPTCHA
     * @param  string $challenge CHALLENGE
     * @throws Exception
     * @return array  Dados da empresa
     */
    public static function consulta($cnpj, $captcha, $challenge){

        $client = new Client();

        $param = array(
            'ACAO' => 'EXIBIRFLT',
            'unifwScrollTop' => '159',
            'unifwScrollLeft' => '0',
            'identificadorCmbOpcao' => '2',
            'filtro' => $cnpj,
            'recaptcha_challenge_field' => $challenge,
            'recaptcha_response_field' => $captcha,
            'chkSelecaoTodos' => '',
            'chkSelecaoTodos' => '',
            'APLICACAO' => '',
            'ACAO_TELA' => '',
            'MODULO' => '',
            'SIGLA' => ''
        );

        $crawler = $client->request('POST', 'http://consultasintegra.fazenda.mg.gov.br/sintegra/ctrl/SINTEGRA/SINTEGRA/CONSULTA_707', $param);

        return self::parser($crawler->html());
    }

    /**
     * Metodo para efetuar o parser
     *
     * @param  Crawler $html HTML
     * @return array  Dados da empresa
     */
    public static function parser(Crawler $crawler){

        $params = [
            'cnpj' => $crawler->filter('#cnpj.identificacaoFormatada')->at
        ];


        return $params;
    }

}