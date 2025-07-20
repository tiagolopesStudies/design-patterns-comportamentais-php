## Padrão State

Problemática:
```php
public function calculateExtraDiscount(): float
    {
        if ($this->status === 'PENDING') {
            return $this->value * 0.05;
        }

        if ($this->status === 'APPROVED') {
            return $this->value * 0.1;
        }

        return 0;
    }
```

Classe base de estado:
```php
abstract class BudgetState
{
    abstract public function calculateExtraDiscount(Budget $budget): float;

    public function approve(Budget $budget): void
    {
        throw new DomainException('This budget could not be approved.');
    }

    public function reprove(Budget $budget): void
    {
        throw new DomainException('This budget could not be reproved.');
    }

    public function finalize(Budget $budget): void
    {
        throw new DomainException('This budget could not be finalized.');
    }
}
```

Implementação de um estado:
```php
class Pending extends BudgetState
{
    public function calculateExtraDiscount(Budget $budget): float
    {
        return 0;
    }

    public function approve(Budget $budget): void
    {
        $budget->status = new Approved;
    }

    public function reprove(Budget $budget): void
    {
        $budget->status = new Reproved;
    }
}
```
