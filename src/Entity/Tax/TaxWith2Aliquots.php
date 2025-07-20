<?php

declare(strict_types=1);

namespace Tiagolopes\DesignPatterns\Entity\Tax;

use Tiagolopes\DesignPatterns\Entity\Budget;

abstract class TaxWith2Aliquots implements TaxInterface
{
    public function calculate(Budget $budget): float
    {
        if ($this->shouldApplyMaxTax($budget)) {
            return $this->calculateMaxTax($budget);
        }

        return $this->calculateMinTax($budget);
    }

    abstract protected function shouldApplyMaxTax(Budget $budget): bool;
    abstract protected function calculateMaxTax(Budget $budget): float;
    abstract protected function calculateMinTax(Budget $budget): float;
}
