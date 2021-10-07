<?php

    use Parceladousa\ParceladoUSA;

    require '../vendor/autoload.php';

    $gateway = new ParceladoUSA('4nv6OIBQSS6eTvwtyiriOCAVuI8iLNNC7QFq9JNv', '1082', ParceladoUSA::SANDBOX);


    $gateway->consultPaymentOrder('19704');
    var_dump($gateway->getResult());
    //    var_dump($gateway->requestAuth('19704'));