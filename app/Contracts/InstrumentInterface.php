<?php

namespace App\Contracts;

interface InstrumentInterface
{
    public function getName();

    public function getCurrentInvest();

    public function getTotalInvest();
}