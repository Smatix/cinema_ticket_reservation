<?php declare(strict_types=1);

namespace App\Schedule\Domain\Factory;

use App\Schedule\Domain\Policy\GapBetweenPolicy;
use App\Schedule\Domain\Policy\NoOverlapsPolicy;
use App\Schedule\Domain\Repository\HallRepositoryInterface;
use App\Schedule\Domain\Show;
use App\Schedule\Domain\Validator\PolicyValidator;
use App\Shared\Uuid\Uuid;
use App\Shared\ValueObject\Price;
use DateTimeImmutable;
use League\Period\Period;

class ShowFactory
{
    private HallRepositoryInterface $hallRepository;
    private PolicyValidator $policyValidator;

    /**
     * @param Uuid $id
     * @param DateTimeImmutable $start
     * @param DateTimeImmutable $end
     * @param Uuid $hallId
     * @param float $price
     * @return Show
     * @throws \App\Schedule\Domain\Exception\InvalidPolicyException
     * @throws \League\Period\Exception
     */
    public function create(Uuid $id, DateTimeImmutable $start, DateTimeImmutable $end, Uuid $hallId, float $price): Show
    {
        $period = new Period($start, $end);

        $this->policyValidator->registerPolicies([
            new NoOverlapsPolicy(),
            new GapBetweenPolicy()
        ]);
        $this->policyValidator->validate($period, $hallId);

        $hall = $this->hallRepository->getByIdOrThrowNotFound($hallId);

        return new Show($id, $period, $hall, new Price($price));
    }
}