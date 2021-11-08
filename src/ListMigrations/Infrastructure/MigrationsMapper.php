<?php

declare(strict_types=1);

namespace App\ListMigrations\Infrastructure;

use App\Shared\Domain\Model\Migration;
use Symfony\Component\Finder\SplFileInfo;

final class MigrationsMapper
{
    /**
     * @param \Symfony\Component\Finder\SplFileInfo[]
     * @return \App\Shared\Domain\Model\Migration[]
     */
    public function filesToModels(array $migrationsFiles): array
    {
        $migrations = [];

        /** @var \Symfony\Component\Finder\SplFileInfo $migrationFile */
        foreach ($migrationsFiles as $migrationFile) {
            $migrations[] = $this->createModel($migrationFile);
        }

        return $migrations;
    }

    private function createModel(SplFileInfo $migrationFile): Migration
    {
        //@TODO add migration description

        return new Migration($migrationFile->getBasename(), date('Y:m:d h:i:s', $migrationFile->getCTime()));
    }
}
