<?php

    namespace Parceladousa;

    use Parceladousa\Interfaces\RequestInterface;
    use Parceladousa\Resources\ConsultPaymentOrder;
    use Parceladousa\Resources\StartParceladoUSA;

    class ParceladoUSA extends StartParceladoUSA
    {
        private $gateway;
        private $fail;
        private $pubKey;
        private $merchantCode;
        private $payment_order_data;
        private $result;
        private $msg;

        public function __construct(string $pubKey, string $merchantCode, string $environment)
        {
            parent::__construct($environment);
            $this->fail = false;
            $this->msg = '';
            $this->pubKey = $pubKey;
            $this->merchantCode = $merchantCode;
        }

        /**
         * @param string $orderId
         * @return $this
         */
        public function consultPaymentOrder(string $orderId): ?self
        {
            return $this->send(new ConsultPaymentOrder($orderId));
        }


        public function request_payment_order($order): self
        {
            if (!$token = $this->requestAuth()->token) {
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

            if ($this->payment_order_data->getHttpCode() !== 200) {
                $this->fail = true;
                return $this;
            }

            return $this;
        }

        /**
         * @return object|null
         */
        private function requestAuth(): ?object
        {
            $data = array(
                'pubKey' => $this->pubKey,
                'merchantCode' => $this->merchantCode
            );

            $request = $this->easyCurl->render('POST', '/auth', $data)->send();

            if ($request->getHttpCode() !== 200) {
                return null;
            }

            return (object)$request->getResult();
        }


        /**
         * @param RequestInterface $requestInterface
         * @return $this|null
         */
        private function send(RequestInterface $requestInterface): ?self
        {
            if (!$token = $this->requestAuth()->token) {
                $this->fail = true;
                return null;
            }

            $request = $this->easyCurl->resetHeader()
                ->setHeader("Authorization:Bearer " . $token)
                ->render($requestInterface->getMethod(), $requestInterface->getRoute(), $requestInterface->getData())
                ->send();
            $this->result = $request->getResult();
            return $this;
        }

        /**
         * @return bool
         */
        public function fail(): bool
        {
            return $this->fail;
        }

        /**
         * @return string
         */
        public function getMsg(): string
        {
            return $this->msg;
        }

        /**
         * @return object
         */
        public function getResult(): object
        {
            return (object)$this->result;
        }


    }