<?php

declare(strict_types=1);

namespace App\RegisterMigrations\Test\Application\RegisterMigrationsHandler;

use App\RegisterMigrations\Application\RegisterMigrationsCommand;
use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;
use App\Shared\Domain\ValueObject\ProjectName;
use Doctrine\ORM\EntityManagerInterface;

final class RegisterMigrationsHandlerTestData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getCommand(): RegisterMigrationsCommand
    {
        return new RegisterMigrationsCommand($this->getProjectId(), $this->getMigrationsFolderPath());
    }

    public function getProjectId(): Id
    {
        return new Id('397C5192-B876-4AFA-8865-52EAE2293B5A');
    }

    public function getMigrationsFolderPath(): MigrationsFolderPath
    {
        return new MigrationsFolderPath('/migrations');
    }

    public function loadProject(): void
    {
        $project = new Project($this->getProjectId(), new ProjectName('test'));

        $this->entityManager->persist($project);
        $this->entityManager->flush();
    }
}
