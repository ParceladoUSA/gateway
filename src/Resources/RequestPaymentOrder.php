<?php

    namespace Parceladousa\Resources;

    use Parceladousa\Interfaces\RequestInterface;
    use Parceladousa\ParceladoUSA;
    use stdClass;

    class RequestPaymentOrder implements RequestInterface
    {
        private $amount;
        private $currency;
        private $name;
        private $email;
        private $phone;
        private $document;
        private $cep;
        private $address;
        private $addressNumber;
        private $city;
        private $state;

        /**
         * @param float $amount
         * @return $this
         */
        public function setAmount(float  $amount): self
        {
            $this->amount = $amount;
            return $this;
        }

        /**
         * @param string $currency
         * @return $this
         */
        public function setCurrency(string  $currency = ParceladoUSA::AMERICANCURRENCY ): self
        {
            $this->currency = $currency;
            return $this;
        }

        /**
         * @param string|null $name
         * @return $this
         */
        public function setName(?string  $name = '' ): self
        {
            $this->name = $name;
            return $this;
        }

        /**
         * @param string|null $email
         * @return $this
         */
        public function setEmail(?string  $email = '' ): self
        {
            $this->email = $email;
            return $this;
        }

        /**
         * @param string|null $phone
         * @return $this
         */
        public function setPhone(?string  $phone = '' ): self
        {
            $this->phone = $phone;
            return $this;
        }

        /**
         * @param string|null $document
         * @return $this
         */
        public function setDocument(?string  $document = '' ): self
        {
            $this->document = $document;
            return $this;
        }

        /**
         * @param string|null $cep
         * @return $this
         */
        public function setCep(?string  $cep = '' ): self
        {
            $this->cep = $cep;
            return $this;
        }

        /**
         * @param string|null $address
         * @return $this
         */
        public function setAddress(?string  $address = '' ): self
        {
            $this->address = $address;
            return $this;
        }

        /**
         * @param string|null $addressNumber
         * @return $this
         */
        public function setAddressNumber(?string  $addressNumber = '' ): self
        {
            $this->addressNumber = $addressNumber;
            return $this;
        }

        /**
         * @param string|null $city
         * @return $this
         */
        public function setCity(?string  $city = '' ): self
        {
            $this->city = $city;
            return $this;
        }

        /**
         * @param string|null $state
         * @return $this
         */
        public function setState(?string  $state = '' ): self
        {
            $this->state = $state;
            return $this;
        }

        /**
         * @param string $callback
         * @return $this
         */
        public function setCallback(string  $callback): self
        {
            $this->callback = $callback;
            return $this;
        }

        public function getRoute(): string
        {
            return "order";
        }

        public function getMethod(): string
        {
            return "POST";
        }

        public function getData(): ?object
        {
            $data = new stdClass();
            $data->amount = $this->amount;
            $data->currency = $this->currency;
            $data->client = new stdClass();
            $data->client->name = $this->name;
            $data->client->email = $this->email;
            $data->client->phone = $this->phone;
            $data->client->doc = $this->document;
            $data->client->cep = $this->cep;
            $data->client->address = $this->address;
            $data->client->addressNumber = $this->addressNumber;
            $data->client->city = $this->city;
            $data->client->state = $this->state;
            $data->callback = $this->callback;
            return (object) $data;
        }
    }