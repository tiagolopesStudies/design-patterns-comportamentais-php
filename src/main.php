<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Tiagolopes\DesignPatterns\Entity\{Budget, Order, OrderList};
use Tiagolopes\DesignPatterns\Entity\Tax\{Iptu, Iss};
use Tiagolopes\DesignPatterns\Services\{DiscountCalculator, TaxCalculator};

$budget             = new Budget(value: 1000, itemsCount: 6);
$taxCalculator      = new TaxCalculator();
$discountCalculator = new DiscountCalculator();

echo $taxCalculator->calculate(budget: $budget, tax: new Iss) . PHP_EOL;
echo $discountCalculator->calculate(budget: $budget) . PHP_EOL;
echo $taxCalculator->calculate(budget: $budget, tax: new Iptu) . PHP_EOL;

$budget->approve();
echo $budget->calculateExtraDiscount() . PHP_EOL;

$clientName = 'Tiago Lopes';

$order1 = new Order($clientName, new Budget(value: 1000, itemsCount: 6));
$order2 = new Order($clientName, new Budget(value: 5000, itemsCount: 1));
$order3 = new Order($clientName, new Budget(value: 10000, itemsCount: 10));

$orderList = new OrderList();
$orderList->add($order1, $order2, $order3);

foreach ($orderList as $order) {
    echo "Client: $order->clientName" . PHP_EOL;
    echo "Value: {$order->budget->value}" . PHP_EOL;
    echo "Items: {$order->budget->itemsCount}" . PHP_EOL;
    echo PHP_EOL;
}
