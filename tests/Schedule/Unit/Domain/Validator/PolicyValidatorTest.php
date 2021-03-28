<?php declare(strict_types=1);

namespace App\Tests\Schedule\Unit\Domain\Validator;

use App\Schedule\Domain\Exception\InvalidPolicyException;
use App\Schedule\Domain\Policy\GapBetweenPolicy;
use App\Schedule\Domain\Policy\NoOverlapsPolicy;
use App\Schedule\Domain\Repository\ShowRepositoryInterface;
use App\Schedule\Domain\Validator\PolicyValidator;
use App\Schedule\Infrastructure\Repository\InMemoryShowRepository;
use App\Shared\Uuid\Uuid;
use App\Tests\Schedule\MotherObject\HallMother;
use App\Tests\Schedule\MotherObject\ShowMother;
use League\Period\Period;
use PHPUnit\Framework\TestCase;

class PolicyValidatorTest extends TestCase
{
    private ShowRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryShowRepository();
        $show = ShowMother::withDates('2020-03-21 9:30', '2020-03-21 11:00');
        $this->repository->save($show);
    }

    public function test_when_data_are_correct_for_all_policies(): void
    {
        $start = \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 12:00');
        $end = \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 14:00');
        $hallId = Uuid::fromString(HallMother::HALL_ID);
        $validator = new PolicyValidator($this->repository);
        $validator->registerPolicies([
            new NoOverlapsPolicy(),
            new GapBetweenPolicy()
        ]);
        try {
            $validator->validate(new Period($start, $end), $hallId);
        } catch (InvalidPolicyException $e) {
            $this->fail();
        }

        $this->assertTrue(true);
    }

    public function test_when_data_are_incorrect_for_policy(): void
    {
        $start = \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 11:10');
        $end = \DateTimeImmutable::createFromFormat('Y-m-d H:i', '2020-03-21 12:00');
        $hallId = Uuid::fromString('a2e9a93e-adcc-4fd5-b92f-636ffb3eac46');
        $validator = new PolicyValidator($this->repository);
        $validator->registerPolicies([
            new NoOverlapsPolicy(),
            new GapBetweenPolicy()
        ]);

        $this->expectException(InvalidPolicyException::class);
        $validator->validate(new Period($start, $end), $hallId);
    }
}