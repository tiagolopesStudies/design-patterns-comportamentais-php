## Padrão Chain of Responsibility

Problemática:

Exemplo:
```php
class DiscountCalculator
{
    public function calculate(Budget $budget): float
    {
        if ($budget->itemsCount > 5) {
            return $budget->value * 0.1;
        }

        if ($budget->value > 500) {
            return $budget->value * 0.05;
        }

        return 0;
    }
}
```

Criação da cadeia de responsabilidades:
```php
abstract class Discount
{
    public function __construct(protected ?Discount $nextDiscount = null)
    {
    }

    public function calculate(Budget $budget): float
    {
        if ($this->shouldApply($budget)) {
            return $this->calculateDiscount($budget);
        }

        return $this->nextDiscount?->calculate($budget) ?? 0;
    }

    abstract public function shouldApply(Budget $budget): bool;

    abstract public function calculateDiscount(Budget $budget): float;
}
```

Adição dos itens da cadeia:
```php
class DiscountMoreThan500Reais extends Discount
{
    public function shouldApply(Budget $budget): bool
    {
        return $budget->value > 500;
    }

    public function calculateDiscount(Budget $budget): float
    {
        return $budget->value * 0.05;
    }
}
```

Utilização:
```php
class DiscountCalculator
{
    public function calculate(Budget $budget): float
    {
        return (new DiscountMoreThan5Items(
            new DiscountMoreThan500Reais()
        ))->calculate($budget);
    }
}
```