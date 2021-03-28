<?php declare(strict_types=1);

namespace App\UI\REST\Controller;

use App\Reservation\Application\Command\CreateReservationCommand;
use App\Shared\CommandBus\CommandBus;
use App\UI\REST\Validator\CreateReservationValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/reservations", methods="POST", name="create_reservation")
     */
    public function createReservation(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $validator = new CreateReservationValidator();
        $validator->validate($data);
        if (!$validator->isValid()) {
            return $this->json($validator->getErrors(), 400);
        }
        $command = new CreateReservationCommand(
            $data['show_id'],
            $data['seats']
        );
        $this->commandBus->dispatch($command);
        return $this->json($command->getId()->toString());
    }
}