# Gateway ParceladoUSA

This package was developed to facilitate integration with ParceladoUSA new API via PHP.

## Installation

Gateway ParceladoUSA is available via Composer:

```bash
"parceladousa/gateway": "1.0.*"
```

or run

```bash
composer require parceladousa/gateway
```


## Documentation

### Details of Construct:
#### The construct has 4 parameters mandatory:

1° pubKey - API Key;<br>
2° merchantCode - Account code with ParceladoUSA;<br>
3° environment - Type of environment where the integration will be performed, ParceladoUSA::SANDBOX or ParceladoUSA::PRODUCTION;<br>
4° callback - URL Where the payment status must be informed.

#### OBS.: The callback route is used to redirect the paying customer to your environment, a parameter will be added to it after the address provided which is the order ID

### Construct:

```PHP
<?php

    use Parceladousa\ParceladoUSA;

    require '../vendor/autoload.php';

    $gateway = new ParceladoUSA(
        'pubKey',
        'merchantCode',
        ParceladoUSA::SANDBOX,
        "https://urlcallback"
    );
```

### Example of transaction creation:
```PHP
<?php

    //Transaction creation
    $data = new stdClass();
    $data->amount = 99.99;
    $data->invoice = 'Invoice Text';
    $data->currency = ParceladoUSA::AMERICANCURRENCY;
    $data->name = 'Customer Name';
    $data->email = 'email@domainofmail.com';
    $data->phone = '(99)99999-9999';
    $data->doc = '99999999999';
    $data->cep = '99999999';
    $data->address = 'Street';
    $data->addressNumber = '1';
    $data->city = 'City';
    $data->state = 'ST';
    $gateway->requestPaymentOrder($data);
    var_dump($gateway->getResult());
```
### Example of transaction query:

```PHP
<?php

    //Transaction query
    $gateway->consultPaymentOrder('orderId');
    var_dump($gateway->getResult());

```

### Example of values query:

```PHP
<?php

    //Values  query
    $data = new stdClass();
    $data->amount = 56.89;
    $gateway->calculateValues($data);
    var_dump($gateway->getResult());

```
##### If you have any questions, please feel free to contact our support via email suporte@parceladousa.com
