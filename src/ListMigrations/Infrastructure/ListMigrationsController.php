<?php

declare(strict_types=1);

namespace App\ListMigrations\Infrastructure;

use App\ListMigrations\Application\ListMigrationsHandler;
use App\ListMigrations\Application\ListMigrationsQuery;
use App\Shared\Domain\ValueObject\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class ListMigrationsController extends AbstractController
{
    public function __construct(private ListMigrationsHandler $handler)
    {
    }

    #[Route(path: '/api/project/{projectId}/migrations', methods: ['GET'])]
    public function listMigrations(string $projectId): JsonResponse
    {
        $migrations = $this->handler->handle(new ListMigrationsQuery(new Id($projectId)));

        return new JsonResponse($migrations);
    }
}
