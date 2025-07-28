<?php

namespace App\Contracts;

interface CurrencyInterface 
{
    public function setValue(string $value);

    public function getValue() : string;
}