<?php

declare(strict_types=1);

namespace App\RegisterMigrations\Application;

use App\Shared\Application\Repository\ProjectRepositoryInterface;
use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\Exception\ProjectNotFoundException;
use App\Shared\Domain\Provider\ProjectProviderInterface;
use App\Shared\Domain\ValueObject\Id;
use LogicException;

final class RegisterMigrationsHandler
{
    public function __construct(
        private ProjectProviderInterface $projectProvider,
        private ProjectRepositoryInterface $projectRepository
    ) {
    }

    public function handle(RegisterMigrationsCommand $command): void
    {
        $project = $this->provideProject($command->getProjectId());

        $project->registerMigrations($command->getMigrationsFolderPath());

        $this->projectRepository->flush();
    }

    private function provideProject(Id $projectId): Project
    {
        try {
            return $this->projectProvider->getOne($projectId);
        } catch (ProjectNotFoundException $e) {
            throw new LogicException($e->getMessage());
        }
    }
}
