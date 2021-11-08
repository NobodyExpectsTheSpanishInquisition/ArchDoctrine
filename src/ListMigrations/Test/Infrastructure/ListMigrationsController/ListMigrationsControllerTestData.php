<?php

declare(strict_types=1);

namespace App\ListMigrations\Test\Infrastructure\ListMigrationsController;

use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;
use App\Shared\Domain\ValueObject\ProjectName;
use Doctrine\ORM\EntityManagerInterface;

final class ListMigrationsControllerTestData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function clean(): void
    {
        $project = $this->entityManager->find(Project::class, (string) $this->getProjectId());

        $this->entityManager->remove($project);
        $this->entityManager->flush();
    }

    private function getProjectId(): Id
    {
        return new Id('CBAEC975-616C-4183-B152-AD7822D25A8C');
    }

    public function getUri(): string
    {
        return sprintf('/api/project/%s/migrations', (string) $this->getProjectId());
    }

    public function loadProject(): void
    {
        $project = new Project($this->getProjectId(), new ProjectName('test'));

        $project->registerMigrations($this->getMigrationsFolderPath());

        $this->entityManager->persist($project);
        $this->entityManager->flush();
    }

    private function getMigrationsFolderPath(): MigrationsFolderPath
    {
        return new MigrationsFolderPath(__DIR__ . '/../../Assets');
    }
}
