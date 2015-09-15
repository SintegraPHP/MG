<?php

require_once '../vendor/autoload.php';

use SintegraPHP\MG\SintegraMG;

if(isset($_POST['captcha']) && isset($_POST['challenge']) && isset($_POST['cnpj'])){

    $result = SintegraMG::consulta($_POST['cnpj'], $_POST['captcha'], $_POST['challenge']);

    var_dump($result);
    die;

}else
    $params = SintegraMG::getParams();
?>

<img src="<?php echo $params['captchaBase64'] ?>" />

<form method="POST">
    <input type="hidden" name="challenge" value="<?php echo $params['challenge'] ?>" />

    <input type="text" name="captcha" placeholder="Captcha" />
    <input type="text" name="cnpj" placeholder="CNPJ" value="07399636001179" />

    <button type="submit">Consultar</button>
</form>