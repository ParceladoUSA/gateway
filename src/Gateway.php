<?php

    namespace Parceladousa;

    use klebervmv\EasyCurl;

    class Gateway
    {

        private $gateway;
        private $fail;
        private $easyCurl;
        private $apiUrl;
        private $pubKey;
        private $merchantCode;


        public function __construct($environment)
        {
            $this->fail = false;

            if($environment == 'sandbox'){
                $this->apiUrl = 'https://apisandbox.parceladousa.com/v1/paymentapi';
            }
            if($environment == 'production'){
                $this->apiUrl = 'https://api.parceladousa.com/v1/paymentapi';
            }

            $this->easyCurl = new EasyCurl($this->apiUrl);
        }

        public function get_auth_token(): ?string
        {
            $data = array (
                'pubKey' => $this->pubKey,
                'merchantCode' => $this->merchantCode
            );

            $request =  $this->easyCurl->render('POST', '/auth', $data)->send();

            if($request->getHttpCode() !== 200){
                return null;
            }

            $response = (object) $request->getResult();
            return $response->token;
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