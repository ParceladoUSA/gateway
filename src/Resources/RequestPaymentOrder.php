<?php

    namespace Parceladousa\Resources;

    class RequestPaymentOrder
    {
        private $amount;
        private $currency;
        private $client;
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
         * @param string|null $amount
         * @return $this
         */
        public function setAmount(?string  $amount = '' ): self
        {
            $this->amount = $amount;
            return $this;
        }

        /**
         * @param string|null $currency
         * @return $this
         */
        public function setCurrency(?string  $currency = '' ): self
        {
            $this->currency = $currency;
            return $this;
        }

        /**
         * @param string|null $client
         * @return $this
         */
        public function setClient(?string  $client = '' ): self
        {
            $this->client = $client;
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
    }