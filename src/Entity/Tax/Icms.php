<?php

declare(strict_types=1);

namespace Tiagolopes\DesignPatterns\Entity\Tax;

use Tiagolopes\DesignPatterns\Entity\Budget;

class Icms implements TaxInterface
{
    public function calculate(Budget $budget): float
    {
        return $budget->value * 0.1;
    }
}
