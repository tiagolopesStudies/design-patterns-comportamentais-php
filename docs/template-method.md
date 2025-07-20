## Padrão Template Method

Problemática:

Exemplo:
```php
// Classe Iptu
class Iptu implements TaxInterface
{
    public function calculate(Budget $budget): float
    {
        if ($budget->value > 1000) {
            return $budget->value * 0.05;
        }

        return 0.1;
    }
}

// Classe Ipva
class Ipva implements TaxInterface
{
    public function calculate(Budget $budget): float
    {
        if ($budget->itemsCount < 3) {
            return $budget->value * 0.025;
        }

        return $budget->value * 0.05;
    }
}
```

Criação da classe com os templates:
```php
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
```

Implementação dos templates nas classes:
```php
// Classe Iptu
class Iptu extends TaxWith2Aliquots
{
    protected function shouldApplyMaxTax(Budget $budget): bool
    {
        return $budget->value < 1000;
    }

    protected function calculateMaxTax(Budget $budget): float
    {
        return $budget->value * 0.05;
    }

    protected function calculateMinTax(Budget $budget): float
    {
        return $budget->value * 0.01;
    }
}

// Classe Ipva
class Ipva extends TaxWith2Aliquots
{
    protected function shouldApplyMaxTax(Budget $budget): bool
    {
        return $budget->itemsCount < 3;
    }

    protected function calculateMaxTax(Budget $budget): float
    {
        return $budget->value * 0.05;
    }

    protected function calculateMinTax(Budget $budget): float
    {
        return $budget->value * 0.025;
    }
}
```
