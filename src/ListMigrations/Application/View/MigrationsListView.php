<?php

declare(strict_types=1);

namespace App\ListMigrations\Application\View;

use JsonSerializable;

class MigrationsListView implements JsonSerializable
{
    /**
     * @var array<int, MigrationView>
     */
    private array $migrations = [];

    public function addMigration(MigrationView $migration): void
    {
        $this->migrations[] = $migration;
    }

    /**
     * @return array<int, <string, string>>
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
