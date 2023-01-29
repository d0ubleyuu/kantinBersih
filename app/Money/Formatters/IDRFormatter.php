<?php

namespace App\Money\Formatters;

use Money\Money;
use Money\MoneyFormatter;

class IDRFormatter implements MoneyFormatter
{
    public function format(Money $money): string
    {
        return 'Rp. ' . $money->getAmount();
    }
}