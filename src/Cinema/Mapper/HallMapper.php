<?php declare(strict_types=1);

namespace App\Cinema\Mapper;

use App\Cinema\DTO\HallDto;
use App\Cinema\Entity\Hall;

class HallMapper
{
    public static function toDto(Hall $hall): HallDto
    {
        $hallDto = new HallDto();
        $hallDto->setId($hall->getId()->toString());
        $hallDto->setSeatsNumber($hall->getSeats());
        return $hallDto;
    }
}