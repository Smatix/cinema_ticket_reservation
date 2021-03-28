<?php declare(strict_types=1);

namespace App\Tests\Schedule\Unit\Domain\Policy;

use App\Schedule\Domain\Policy\GapBetweenPolicy;
use League\Period\Period;
use PHPUnit\Framework\TestCase;

class GapBetweenPolicyTest extends TestCase
{
    public function test_when_is_gap_between_before_period(): void
    {
        $period = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 9:30'),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 11:00'),
        );

        $periods = $this->get_periods();

        $policy = new GapBetweenPolicy();
        $this->assertTrue($policy->isSatisfied($period, $periods));
    }

    public function test_when_is_not_gap_between_before_period(): void
    {
        $period = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 9:29'),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 11:00'),
        );

        $periods = $this->get_periods();

        $policy = new GapBetweenPolicy();
        $this->assertFalse($policy->isSatisfied($period, $periods));
    }

    public function test_when_is_gap_between_after_period(): void
    {
        $period = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 9:30'),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 11:30'),
        );

        $periods = $this->get_periods();

        $policy = new GapBetweenPolicy();
        $this->assertTrue($policy->isSatisfied($period, $periods));
    }

    public function test_when_is_not_gap_between_after_period(): void
    {
        $period = new Period(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 10:00'),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 11:31'),
        );

        $periods = $this->get_periods();

        $policy = new GapBetweenPolicy();
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