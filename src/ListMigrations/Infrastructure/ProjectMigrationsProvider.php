<?php

declare(strict_types=1);

namespace App\ListMigrations\Infrastructure;

use App\ListMigrations\Domain\ProjectMigrationsProviderInterface;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;
use App\Shared\Infrastructure\FileSystem\SymfonyFinderFileSystem;
use AppendIterator;
use Iterator;

final class ProjectMigrationsProvider implements ProjectMigrationsProviderInterface
{
    public function __construct(private SymfonyFinderFileSystem $fileSystem, private MigrationsMapper $migrationsMapper)
    {
    }

    /**
     * @inheritDoc
     */
    public function provideMigrationsForProject(MigrationsFolderPath $migrationsFolderPath): array
    {
        $migrationsFiles = $this->fileSystem->in((string) $migrationsFolderPath)
            ->files()
            ->filter(MigrationFileFilterCallback::get())
            ->sortByModifiedTime()
            ->getIterator();

        return $this->migrationsMapper->filesToModels($this->castToArray($migrationsFiles));
    }

    private function castToArray(array|Iterator|AppendIterator $migrationsFiles): array
    {
        return (array) $migrationsFiles;
    }
}
