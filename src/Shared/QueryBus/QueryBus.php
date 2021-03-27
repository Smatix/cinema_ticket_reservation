<?php declare(strict_types=1);

namespace App\Shared\QueryBus;

use App\Shared\Query\Query;

interface QueryBus
{
    /** @return mixed */
    public function handle(Query $query);
}