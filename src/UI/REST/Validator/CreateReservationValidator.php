<?php declare(strict_types=1);

namespace App\UI\REST\Validator;

class CreateReservationValidator
{
    private bool $isValid;
    /**
     * @var string[]
     */
    private array $errors;

    /**
     * @param mixed[] $data
     */
    public function validate(array $data): void
    {
        if (!array_key_exists('show_id', $data)) {
            $this->errors[] = 'Show is required';
            $this->isValid = false;
        }

        if (!array_key_exists('seats', $data)) {
            $this->errors[] = 'Seats is required';
            $this->isValid = false;
        }
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}