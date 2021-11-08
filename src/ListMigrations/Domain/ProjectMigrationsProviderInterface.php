<?php

declare(strict_types=1);

namespace App\ListMigrations\Domain;

use App\Shared\Domain\Model\Migration;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;

interface ProjectMigrationsProviderInterface
{
    /**
     * @return array<Migration>
     */
    public function provideMigrationsForProject(MigrationsFolderPath $migrationsFolderPath): array;
}
