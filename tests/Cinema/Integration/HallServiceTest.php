<?php declare(strict_types=1);

namespace App\Tests\Cinema\Integration;

use App\Cinema\DTO\HallDto;
use App\Cinema\Event\HallAdded;
use App\Cinema\Repository\HallRepository;
use App\Cinema\Repository\HallRepositoryInterface;
use App\Cinema\Service\HallService;
use App\Shared\EventBus\EventBus;
use App\Shared\EventBus\InMemoryEventBus;
use App\Tests\Helpers\DatabaseHelper;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HallServiceTest extends KernelTestCase
{
    private HallService $hallService;
    private HallRepositoryInterface $hallRepository;
    private InMemoryEventBus $eventBus;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        DatabaseHelper::createSchema(self::$kernel);
        $em = self::$container->get('doctrine.orm.entity_manager');
        $this->hallRepository = new HallRepository($em);
        $this->eventBus = new InMemoryEventBus();
        $this->hallService = new HallService(
            $this->hallRepository,
            $this->eventBus
        );
    }

    public function test_add_new_hall_with_correct_data(): void
    {
        $hallDto = new HallDto();
        $hallDto->setSeatsNumber(100);

        $id = $this->hallService->addHall($hallDto);

        $hall = $this->hallRepository->getByIdOrThrowNotFound($id);
        $dispatchedEvent = $this->eventBus->getDispatchedEvent();

        $this->assertInstanceOf(HallAdded::class, $dispatchedEvent);
        $this->assertEquals(100, $hall->getSeats());
    }

    protected function tearDown(): void
    {
        DatabaseHelper::dropSchema(self::$kernel);
        parent::tearDown();
    }
}