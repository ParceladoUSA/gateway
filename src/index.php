<?php

    use Parceladousa\ParceladoUSA;

    require '../vendor/autoload.php';

    $gateway = new ParceladoUSA(ParceladoUSA::SANDBOX);
    $gateway->setPubKey('4nv6OIBQSS6eTvwtyiriOCAVuI8iLNNC7QFq9JNv')
        ->setMerchantCode('1082');

    $gateway->consult_payment_order('19704');
//    var_dump($gateway->requestAuth('19704'));