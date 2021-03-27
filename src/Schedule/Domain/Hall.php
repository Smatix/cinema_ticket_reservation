<?php declare(strict_types=1);

namespace App\Schedule\Domain;

use App\Shared\Uuid\Uuid;

class Hall
{
    private Uuid $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
}