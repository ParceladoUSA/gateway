<?php

    use Parceladousa\ParceladoUSA;

    require '../vendor/autoload.php';

    $gateway = new ParceladoUSA(
        '4nv6OIBQSS6eTvwtyiriOCAVuI8iLNNC7QFq9JNv',
        '1082',
        ParceladoUSA::SANDBOX,
        "https://SEUHOST/seuendpoint"
    );

//    //Registrar Ordem de Pagamento
//    $data = new stdClass();
//    $data->amount = 56.89;
//    $data->currency = ParceladoUSA::AMERICANCURRENCY;
//    $data->name = 'Rogerio Marinho';
//    $data->email = 'rgda@seudominio.com';
//    $data->phone = '(99)99999-9999';
//    $data->doc = '99999999999';
//    $data->cep = '99999999';
//    $data->address = 'Rua';
//    $data->addressNumber = '1';
//    $data->city = 'Cidade';
//    $data->state = 'ST';
//    $gateway->requestPaymentOrder($data);
//    var_dump($gateway->getResult());

//    //Consultar Ordem de Pagamento
//    $gateway->consultPaymentOrder('19712');
//    var_dump($gateway->getResult());

