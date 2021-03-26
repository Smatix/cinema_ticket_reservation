<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Uuid;

use Symfony\Component\Uid\Uuid as SymfonyUuid;

class Uuid
{
    private SymfonyUuid $id;

    private function __construct(SymfonyUuid $id)
    {
        $this->id = $id;
    }

    public static function generate(): Uuid
    {
        return new self(SymfonyUuid::v4());
    }

    public static function fromString(string $id): Uuid
    {
        return new self(SymfonyUuid::fromString($id));
    }

    public function toString(): string
    {
        return $this->id->toRfc4122();
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @param string | Uuid $uuid
     * @return bool
     */
    public function equals($uuid): bool
    {
        if ($uuid instanceof Uuid) {
            return $this->toString() === $uuid->toString();
        }
        return $this->toString() === $uuid;
    }
}