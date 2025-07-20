## Padrão Command

Problemática:
```php
if (count($argv) < 3 || count($argv) > 4) {
    echo 'Usage: php create-order.php "<client-name>" <budget-value> [items-count]' . PHP_EOL;
    exit(1);
}

$clientName = $argv[1];
$budgetValue = (float) $argv[2];
$itemsCount = isset($argv[3]) ? (int) $argv[3] : 1;

$budget = new Budget(1000, 1);
echo "Creating order in database..." . PHP_EOL;
echo "Sending email to {$clientName}..." . PHP_EOL;
```

Interface do Command:
```php
interface CommandInterface
{
    public function execute(): void;
}
```

Implementação de um Command:
```php
readonly class GenerateOrderCommand implements CommandInterface
{
    public function __construct(
        private GenerateOrderDto $generateOrderDto,
        private OrderServiceReceiver $orderService
    ) {
    }

    public function execute(): void
    {
        $budget = new Budget($this->generateOrderDto->value, $this->generateOrderDto->itemsCount);

        $this->orderService->createOrder($this->generateOrderDto->clientName, $budget);
        $this->orderService->sendEmail($this->generateOrderDto->clientName);
    }
}
```

Receiver do Command:
```php
class OrderServiceReceiver
{
    public function createOrder(string $clientName, Budget $budget): void
    {
        echo "Creating order in database..." . PHP_EOL;
    }

    public function sendEmail(string $clientName): void
    {
        echo "Sending email to {$clientName}..." . PHP_EOL;
    }
}
```

Invoker do Command:
```php
class CommandInvoker
{
    private array $commands = [];

    public function addCommand(CommandInterface $command): void
    {
        $this->commands[] = $command;
    }

    public function executeCommands(): void
    {
        /** @var CommandInterface $command */
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }

    public function clearCommands(): void
    {
        $this->commands = [];
    }
}
```
