<?php

declare(strict_types=1);

namespace App\RegisterProject\Infrastructure;

use App\RegisterProject\Application\RegisterProjectCommand;
use App\RegisterProject\Application\RegisterProjectHandler;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\ProjectName;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class RegisterProjectController extends AbstractController
{
    public function __construct(private RegisterProjectHandler $handler)
    {
    }

    #[Route(path: '/api/project', methods: ['POST'])]
    public function registerProject(Request $request): JsonResponse
    {
        $id = new Id($request->request->get('id'));
        $name = new ProjectName($request->request->get('name'));

        $this->handler->handle(new RegisterProjectCommand($id, $name));

        return new JsonResponse(null, 201);
    }
}
