# Sintegra MG

[![Travis](https://travis-ci.org/SintegraPHP/MG.svg?branch=1.0)](https://travis-ci.org/SintegraPHP/MG)

Consulte gratuitamente CNPJ no site do Sintegra/MG

### Como utilizar

Adicione a library

```sh
$ composer require sintegraphp/mg
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
