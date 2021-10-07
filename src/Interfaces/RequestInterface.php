<?php

    namespace Parceladousa\Interfaces;

    interface RequestInterface
    {
        public function getRoute(): string;

        public function getMethod(): string;

        public function getData(): ?object;

    }