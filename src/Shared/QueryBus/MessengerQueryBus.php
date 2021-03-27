<?php declare(strict_types=1);

namespace App\Shared\QueryBus;

use App\Shared\Query\Query;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    /** @return mixed */
    public function handle(Query $query)
    {
        return $this->handleQuery($query);
    }
}