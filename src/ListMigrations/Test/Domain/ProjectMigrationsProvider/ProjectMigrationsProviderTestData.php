<?php

declare(strict_types=1);

namespace App\ListMigrations\Test\Domain\ProjectMigrationsProvider;

use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;
use App\Shared\Domain\ValueObject\ProjectName;
use Doctrine\ORM\EntityManagerInterface;

final class ProjectMigrationsProviderTestData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getMigrationFileName(): string
    {
        return 'Version00000000000000.php';
    }

    public function loadProject(): void
    {
        $project = new Project($this->getProjectId(), new ProjectName('test'));

        $project->registerMigrations($this->getMigrationsFolderPath());

        $this->entityManager->persist($project);
        $this->entityManager->flush();
    }

    public function getProjectId(): Id
    {
        return new Id('9CCCEDBF-8B8E-487A-A6D6-8A6AA118252A');
    }

    public function getMigrationsFolderPath(): MigrationsFolderPath
    {
        return new MigrationsFolderPath(__DIR__ . '/../../Assets');
    }
}
