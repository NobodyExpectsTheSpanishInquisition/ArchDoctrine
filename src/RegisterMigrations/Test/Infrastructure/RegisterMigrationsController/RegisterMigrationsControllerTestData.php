<?php

declare(strict_types=1);

namespace App\RegisterMigrations\Test\Infrastructure\RegisterMigrationsController;

use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\ProjectName;
use Doctrine\ORM\EntityManagerInterface;

final class RegisterMigrationsControllerTestData
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

    public function getProjectId(): Id
    {
        return new Id('AFAC08BC-5A57-47BB-80D7-0DEC9F1B5971');
    }

    /**
     * @return array<string, string>
     */
    public function getRequestParams(): array
    {
        return ['migrationsFolderPath' => '/migrations'];
    }

    public function getUri(): string
    {
        return sprintf('/api/project/%s/migrations', (string) $this->getProjectId());
    }

    public function loadProject(): void
    {
        $project = new Project($this->getProjectId(), new ProjectName('test'));

        $this->entityManager->persist($project);
        $this->entityManager->flush();
    }
}
