<?php

    namespace Parceladousa;

    use Parceladousa\Interfaces\RequestInterface;
    use Parceladousa\Resources\ConsultPaymentOrder;
    use Parceladousa\Resources\RequestPaymentOrder;
    use Parceladousa\Resources\StartParceladoUSA;

    class ParceladoUSA extends StartParceladoUSA
    {
        private $fail;
        private $pubKey;
        private $merchantCode;
        private $result;
        private $msg;
        private $callback;

        public function __construct(string $pubKey, string $merchantCode, string $environment, string $callback)
        {
            parent::__construct($environment);
            $this->fail = false;
            $this->msg = '';
            $this->pubKey = $pubKey;
            $this->merchantCode = $merchantCode;
            $this->callback = $callback;
        }

        /**
         * @param string $orderId
         * @return $this
         */
        public function consultPaymentOrder(string $orderId): ?self
        {
            return $this->send(new ConsultPaymentOrder($orderId));
        }

        /**
         * @param string $orderId
         * @return $this
         */
        public function requestPaymentOrder(object $data): ?self
        {
            $request = new RequestPaymentOrder();
            $request->setAmount($data->amount);
            $request->setCurrency($data->currency);
            $request->setName($data->name);
            $request->setEmail($data->email);
            $request->setPhone($data->phone);
            $request->setDocument($data->doc);
            $request->setCep($data->cep);
            $request->setAddress($data->address);
            $request->setAddressNumber($data->addressNumber);
            $request->setCity($data->city);
            $request->setState($data->state);
            $request->setCallback($this->callback);
            return $this->send($request);
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