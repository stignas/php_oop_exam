<?php
declare(strict_types=1);

namespace eas\Models;

use eas\Interfaces\PaymentDeclarationInterface;

class NightRatePaymentDeclaration implements PaymentDeclarationInterface
{
    const RATE = 'Naktinis';
    private float $quantity;
    private float $priceRate;
    private string $month;
    private string $status = "NotPaid";

    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setPriceRate(float $priceRate): void
    {
        $this->priceRate = $priceRate;
    }

    public function setMonth(string $month): void
    {
        $this->month = $month;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getPriceRate(): float
    {
        return $this->priceRate;
    }

    public function getMonth(): string
    {
        return $this->month;
    }

    public function getRate(): string
    {
        return self::RATE;
    }

    public function getSum(): float
    {
        return round($this->priceRate * $this->quantity,2);
    }

    public function setPaid(string $status): void
    {
        $this->status = "Paid";
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}