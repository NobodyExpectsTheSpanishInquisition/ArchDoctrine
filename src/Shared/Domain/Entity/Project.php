<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity;

use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;
use App\Shared\Domain\ValueObject\ProjectName;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'project')]
final class Project
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

    public function getId(): Id
    {
        return new Id($this->id);
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
