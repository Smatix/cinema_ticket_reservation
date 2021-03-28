<?php declare(strict_types=1);

namespace App\Schedule\Infrastructure\Repository;

use App\Schedule\Domain\Repository\ShowRepositoryInterface;
use App\Schedule\Domain\Show;
use App\Shared\Exception\NotFoundException;
use App\Shared\Uuid\Uuid;
use DateTimeImmutable;

class InMemoryShowRepository implements ShowRepositoryInterface
{
    /**
     * @var Show[] $shows
     */
    private array $shows;

    public function getByIdOrThrowNotFound(Uuid $id): Show
    {
        foreach ($this->shows as $show) {
            if ($show->getId()->equals($id)) {
                return $show;
            }
        }
        throw new NotFoundException();
    }

    public function getByDatesAndHallId(DateTimeImmutable $start, DateTimeImmutable $end, Uuid $hallId): array
    {
        return $this->shows;
    }

    public function save(Show $show): void
    {
        $this->shows[] = $show;
    }

    public function remove(Show $show): void
    {
        for ($i = 0; $i < count($this->shows) ; $i++) {
            if ($this->shows[$i]->getId()->equals($show->getId())) {
                unset($this->shows[$i]);
            }
        }
    }

}