<?php

namespace eas\Interfaces;

interface PaymentDeclarationInterface
{
    public function setQuantity(float $quantity): void;
    public function setPriceRate(float $priceRate): void;
    public function setPaid(string $status): void;
    public function setMonth(string $month): void;
    public function getQuantity(): float;
    public function getPriceRate(): float;
    public function getRate(): string;
    public function getStatus(): string;
    public function getMonth(): string;
    public function getSum(): float;
}