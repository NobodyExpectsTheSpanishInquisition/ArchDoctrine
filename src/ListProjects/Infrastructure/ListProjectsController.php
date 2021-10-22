<?php

declare(strict_types=1);

namespace App\ListProjects\Infrastructure;

use App\ListProjects\Application\ListProjectsHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class ListProjectsController extends AbstractController
{
    public function __construct(private ListProjectsHandler $handler)
    {
    }

    #[Route(path: '/api/projects', methods: ['GET'])]
    public function listProjects(): JsonResponse
    {
        return new JsonResponse($this->handler->handle());
    }
}
