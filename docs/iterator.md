# Padrão Iterator

Problemática:
```php
$clientName = 'Tiago Lopes';

$order1 = new Order($clientName, new Budget(value: 1000, itemsCount: 6));
$order2 = new Order($clientName, new Budget(value: 5000, itemsCount: 1));
$order3 = new Order($clientName, new Budget(value: 10000, itemsCount: 10));

$orders = [$order1, $order2, $order3, 'invalid'];

foreach ($orders as $order) {
    echo "Client: $order->clientName" . PHP_EOL;
    echo "Value: {$order->budget->value}" . PHP_EOL;
    echo "Items: {$order->budget->itemsCount}" . PHP_EOL;
    echo PHP_EOL;
}
```

Implementando o iterator:
```php
class OrderList implements IteratorAggregate
{
    /** @var array<Order> $orders */
    private array $orders;

    public function __construct()
    {
        $this->orders = [];
    }

    public function add(Order ...$orders): void
    {
        array_push($this->orders, ...$orders);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->orders);
    }
}
```
