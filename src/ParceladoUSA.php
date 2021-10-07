<?php

    namespace Parceladousa;

    use klebervmv\EasyCurl;

    class ParceladoUSA
    {
        const ENDPOINT_SANDBOX = 'https://apisandbox.parceladousa.com/v1/paymentapi';
        const ENDPOINT_PRODUCTION = 'https://api.parceladousa.com/v1/paymentapi';
        const SANDBOX = 'sandbox';
        const PRODUCTION = 'production';

        private $gateway;
        private $fail;
        private $easyCurl;
        private $apiUrl;
        private $pubKey;
        private $merchantCode;
        private $payment_order_data;


        public function __construct($environment)
        {
            $this->fail = false;
            $this->apiUrl = ($environment === self::SANDBOX)? self::ENDPOINT_SANDBOX : self::ENDPOINT_PRODUCTION;
            $this->easyCurl = new EasyCurl($this->apiUrl);
        }

        private function requestAuth()
        {
            $data = array (
                'pubKey' => $this->pubKey,
                'merchantCode' => $this->merchantCode
            );

            $request =  $this->easyCurl->render('POST', '/auth', $data)->send();

            if($request->getHttpCode() !== 200){
                return null;
            }


            return (object) $request->getResult();
        }

        public function request_payment_order($order): self
        {
            if(!$token = $this->requestAuth()->token){
                $this->fail = true;
                return $this;
            }

            $data = array(
                'amount' => $amount,
                "currency" => 'USD',
                'client' => array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'doc' => $document,
                    'cep' => $cep,
                    'address' => $address,
                    'addressNumber' => $number,
                    'city' => $city,
                    'state' => $state
                ),
                'callback' => ''
            );

            $this->payment_order_data = $this->easyCurl->resetHeader()
                ->setHeader("Authorization:Bearer " . $token)
                ->render("POST", "/order", $data)
                ->send();

            if($this->payment_order_data->getHttpCode() !== 200){
                $this->fail = true;
                return $this;
            }

            return $this;
        }


        public function setPubKey(string $pubKey): self
        {
            $this->pubKey = $pubKey;
            return $this;

        }
        public function setMerchantCode(string $merchantCode): self
        {
            $this->merchantCode = $merchantCode;
            return $this;
        }

        public function fail(){
            return $this->fail;
        }
    }