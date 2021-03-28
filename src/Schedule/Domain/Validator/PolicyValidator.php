<?php declare(strict_types=1);

namespace App\Schedule\Domain\Validator;

use App\Shared\Exception\InvalidPolicyException;
use App\Schedule\Domain\Policy\Policy;
use App\Schedule\Domain\Repository\ShowRepositoryInterface;
use App\Schedule\Domain\Show;
use App\Shared\Uuid\Uuid;
use League\Period\Period;

class PolicyValidator
{
    /**
     * @var Policy[] $policies
     */
    private array $policies;
    private ShowRepositoryInterface $showRepository;

    public function __construct(ShowRepositoryInterface $showRepository)
    {
        $this->showRepository = $showRepository;
    }

    /**
     * @param Period $period
     * @param Uuid $hallId
     * @throws InvalidPolicyException
     */
    public function validate(Period $period, Uuid $hallId): void
    {
        $shows = $this->showRepository->getByDatesAndHallId($period->getStartDate(), $period->getEndDate(), $hallId);

        $showsPeriods = array_map(function (Show $show) {
            return $show->getPeriod();
        }, $shows);

        foreach ($this->policies as $policy) {
            if (!$policy->isSatisfied($period, $showsPeriods)) {
                throw new InvalidPolicyException($policy->getNotSatisfiedMessage());
            }
        }
    }

    /**
     * @param Policy[] $policies
     */
    public function registerPolicies(array $policies): void
    {
        $this->policies = $policies;
    }
}