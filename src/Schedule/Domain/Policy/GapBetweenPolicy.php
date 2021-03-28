<?php declare(strict_types=1);

namespace App\Schedule\Domain\Policy;

use League\Period\Duration;
use League\Period\Period;

class GapBetweenPolicy implements Policy
{
    const GAP_BETWEEN_IN_MINUTES = 30;

    public function isSatisfied(Period $period, array $periods): bool
    {
        $anyOverlaps = array_filter($periods, function (Period $periodItem) use ($period) {
            $extendedPeriod = $periodItem->expand(Duration::createFromSeconds(self::GAP_BETWEEN_IN_MINUTES*60));
            return $extendedPeriod->overlaps($period);
        });

        return empty($anyOverlaps);
    }

    public function getNotSatisfiedMessage(): string
    {
        return "Should be gap between shows";
    }
}