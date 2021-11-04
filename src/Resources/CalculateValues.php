<?php

    namespace Parceladousa\Resources;

    use Parceladousa\Interfaces\RequestInterface;
    use stdClass;

    class CalculateValues implements RequestInterface
    {
        private $amount;

        /**
         * @param float $amount
         * @return $this
         */
        public function setAmount(float $amount): self
        {
            $this->amount = $amount;
            return $this;
        }


        public function getRoute(): string
        {
            return "calculate";
        }

        public function getMethod(): string
        {
            return "POST";
        }

        public function getData(): ?object
        {
            $data = new stdClass();
            $data->amount = $this->amount;
            return (object)$data;
        }
    }