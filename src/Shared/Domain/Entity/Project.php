<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

use App\ListMigrations\Domain\ProjectMigrationsProviderInterface;
use App\Shared\Domain\Exception\ProjectHasNotRegisteredMigrationsException;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;
use App\Shared\Domain\ValueObject\ProjectName;
use Doctrine\ORM\Mapping as ORM;
use PHPUnit\TextUI\XmlConfiguration\Migration;

#[ORM\Entity]
#[ORM\Table(name: 'project')]
class Project
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $migrationsFolderPath = null;

    public function __construct(Id $id, ProjectName $name)
    {
        $this->id = (string) $id;
        $this->name = (string) $name;
    }

    /**
     * @return array<Migration>
     * @throws \App\Shared\Domain\Exception\ProjectHasNotRegisteredMigrationsException
     */
    public function fetchMigrations(ProjectMigrationsProviderInterface $projectMigrationsProvider): array
    {
        if ($this->hasRegisteredMigrations() === false) {
            throw ProjectHasNotRegisteredMigrationsException::get($this->getId());
        }

        return $projectMigrationsProvider->provideMigrationsForProject($this->getMigrationsFolderPath());
    }

    private function hasRegisteredMigrations(): bool
    {
        return $this->migrationsFolderPath !== null;
    }

    public function getId(): Id
    {
        return new Id($this->id);
    }

    private function getMigrationsFolderPath(): MigrationsFolderPath
    {
        return new MigrationsFolderPath($this->migrationsFolderPath);
    }

    public function getName(): ProjectName
    {
        return new ProjectName($this->name);
    }

    public function registerMigrations(MigrationsFolderPath $migrationsFolderPath): void
    {
        $this->migrationsFolderPath = (string) $migrationsFolderPath;
    }
}
