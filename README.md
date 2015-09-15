# Sintegra MG

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

### Gostou? Conheça também

* [CnpjGratis](https://github.com/jansenfelipe/cnpj-gratis)
* [CpfGratis](https://github.com/jansenfelipe/cpf-gratis)
* [CepGratis](https://github.com/jansenfelipe/cep-gratis)
* [Nfephp-serialize](https://github.com/jansenfelipe/nfephp-serialize)

### License

The MIT License (MIT)
