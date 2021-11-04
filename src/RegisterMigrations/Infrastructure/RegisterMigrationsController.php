<?php

declare(strict_types=1);

namespace App\RegisterMigrations\Infrastructure;

use App\RegisterMigrations\Application\RegisterMigrationsCommand;
use App\RegisterMigrations\Application\RegisterMigrationsHandler;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class RegisterMigrationsController extends AbstractController
{
    public function __construct(private RegisterMigrationsHandler $handler)
    {
    }

    #[Route(path: '/api/project/{projectId}/migrations', methods: ['PATCH'])]
    public function registerMigrations(Request $request, string $projectId): JsonResponse
    {
        $this->handler->handle(
            new RegisterMigrationsCommand(
                new Id($projectId),
                new MigrationsFolderPath($request->request->get('migrationsFolderPath'))
            )
        );

        return new JsonResponse(null, 204);
    }
}
