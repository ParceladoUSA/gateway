<?php

    namespace Parceladousa\Resources;

    use Parceladousa\ParceladoUSA;

    class ConsultPaymentOrder extends ParceladoUSA
    {
        public function __construct($environment)
        {

            parent::__construct($environment);
            if(!$token = $this->requestAuth()->token){
                $this->fail = true;
                return $this;
            }

            $this->payment_order_data = $this->easyCurl->resetHeader()
                ->setHeader("Authorization:Bearer " . $token)
                ->render("GET", "/order/$order_id")
                ->send();

            if($this->payment_order_data->getHttpCode() !== 200){
                $this->fail = true;
                return $this;
            }
            return $this;
        }
    }