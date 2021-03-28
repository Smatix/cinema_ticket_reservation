<?php declare(strict_types=1);

namespace App\UI\REST\Controller;

use App\Cinema\DTO\HallDto;
use App\Cinema\Service\HallService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private HallService $service;

    public function __construct(HallService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/halls", methods="POST", name="add_hall")
     */
    public function home(): Response
    {
        $dto = new HallDto();
        $dto->setSeatsNumber(100);
        $id = $this->service->addHall($dto);

        return $this->json($id);
    }
}