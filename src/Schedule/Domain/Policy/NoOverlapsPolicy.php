<?php declare(strict_types=1);

namespace App\Schedule\Domain\Policy;

use League\Period\Period;

class NoOverlapsPolicy implements Policy
{

    public function isSatisfied(Period $period, array $periods): bool
    {
        $anyOverlaps = array_filter($periods, function (Period $periodItem) use ($period) {
           return $periodItem->overlaps($period);
        });

        return empty($anyOverlaps);
    }

    public function getNotSatisfiedMessage(): string
    {
        return "Shows overlap";
    }
}