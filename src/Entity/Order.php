<?php

declare(strict_types=1);

namespace Tiagolopes\DesignPatterns\Entity;

use DateTimeImmutable;

class Order
{
    public function __construct(
        public string $clientName,
        public Budget $budget,
        public ?DateTimeImmutable $finalizedAt = null
    ) {
    }
}
