<?php

    use Parceladousa\Gateway;

    require '../vendor/autoload.php';

    $gateway = (new Gateway('sandbox'))
        ->setPubKey('4nv6OIBQSS6eTvwtyiriOCAVuI8iLNNC7QFq9JNv')
        ->setMerchantCode('1082');

    var_dump($gateway->get_auth_token());