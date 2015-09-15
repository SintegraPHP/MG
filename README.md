# Sintegra MG

[![Travis](https://travis-ci.org/SintegraPHP/MG.svg?branch=1.0)](https://travis-ci.org/SintegraPHP/MG)
[![Latest Stable Version](https://poser.pugx.org/sintegra-php/mg/v/stable)](https://packagist.org/packages/sintegra-php/mg) 
[![Total Downloads](https://poser.pugx.org/sintegra-php/mg/downloads)](https://packagist.org/packages/sintegra-php/mg)
[![Latest Unstable Version](https://poser.pugx.org/sintegra-php/mg/v/unstable)](https://packagist.org/packages/sintegra-php/mg)
[![License](https://poser.pugx.org/sintegra-php/mg/license)](http://opensource.org/licenses/MIT)

Consulte gratuitamente CNPJ no site do Sintegra/MG

### Como utilizar

Adicione a library

```sh
$ composer require sintegra-php/mg
```

Adicione o autoload.php do composer no seu arquivo PHP.

```php
require_once 'vendor/autoload.php';  
```

Primeiro chame o método `getParams()` para retornar os dados necessários para enviar no método `consulta()` 

```php
$params = SintegraPHP\MG\SintegraMG::getParams();
```

Agora basta chamar o método `consulta()`

```php
$dadosEmpresa = SintegraPHP\MG\SintegraMG::consulta(
    '07399636001179',
    'INFORME_AS_LETRAS_DO_CAPTCHA',
    $params['challenge']
);
```

### License

The MIT License (MIT)
