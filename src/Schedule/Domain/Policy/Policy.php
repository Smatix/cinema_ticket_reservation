<?php declare(strict_types=1);

namespace App\Schedule\Domain\Policy;

use League\Period\Period;

interface Policy
{
    /**
     * @param Period $period
     * @param Period[] $periods
     * @return bool
     */
    public function isSatisfied(Period $period, array $periods): bool;

    public function getNotSatisfiedMessage(): string;
}