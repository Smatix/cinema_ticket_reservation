<?php declare(strict_types=1);

namespace App\Tests\Schedule\Unit\Domain\Policy;

use App\Schedule\Domain\Policy\NoOverlapsPolicy;
use League\Period\Period;
use PHPUnit\Framework\TestCase;

class NoOverlapsPolicyTest extends TestCase
{
    public function test_if_period_no_overlap_with_other(): void
    {
        $period = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 10:00'),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 11:00'),
        );

        $periods = $this->get_periods();

        $policy = new NoOverlapsPolicy();
        $this->assertTrue($policy->isSatisfied($period, $periods));
    }

    public function test_if_period_overlap_with_other(): void
    {
        $period = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 8:30'),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 11:00'),
        );

        $periods = $this->get_periods();

        $policy = new NoOverlapsPolicy();
        $this->assertFalse($policy->isSatisfied($period, $periods));
    }

    /**
     * @return Period[]
     * @throws \League\Period\Exception
     */
    public function get_periods(): array
    {
        $period1 = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 8:00'),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 9:00'),
        );

        $period2 = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 12:00'),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 14:00'),
        );

        return [$period1, $period2];
    }
}