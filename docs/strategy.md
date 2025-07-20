## Padrão Strategy

Problemática:

Exemplo:
```php
class TaxCalculator
{
    public function calculate(Budget $budget, TaxInterface $tax): float
    {
        return match ($taxName) {
            'ICMS' => $budget->value * 0.1,
            'ISS' => $budget->value * 0.07,
            default => $budget->value,
        };
    }
}
```

Refatoração:

Interface:
```php
interface TaxInterface
{
    public function calculate(Budget $budget): float;
}
```

Implementação da interface:
```php
class Icms implements TaxInterface
{
    public function calculate(Budget $budget): float
    {
        return $budget->value * 0.1;
    }
}
```

Utilização:
```php
class TaxCalculator
{
    public function calculate(Budget $budget, TaxInterface $tax): float
    {
        return $tax->calculate($budget);
    }
}
```
