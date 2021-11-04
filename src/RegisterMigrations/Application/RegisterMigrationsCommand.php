<?php

declare(strict_types=1);

namespace App\RegisterMigrations\Application;

use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;

final class RegisterMigrationsCommand
{
    public function __construct(private Id $projectId, private MigrationsFolderPath $migrationsFolderPath)
    {
    }

    public function getMigrationsFolderPath(): MigrationsFolderPath
    {
        return $this->migrationsFolderPath;
    }

    public function getProjectId(): Id
    {
        return $this->projectId;
    }
}
