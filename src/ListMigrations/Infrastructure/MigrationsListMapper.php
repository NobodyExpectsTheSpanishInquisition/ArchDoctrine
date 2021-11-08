<?php

declare(strict_types=1);

namespace App\ListMigrations\Infrastructure;

use App\ListMigrations\Application\MigrationsListMapperInterface;
use App\ListMigrations\Application\View\MigrationsListView;
use App\ListMigrations\Application\View\MigrationView;
use App\Shared\Domain\Model\Migration;

final class MigrationsListMapper implements MigrationsListMapperInterface
{
    /**
     * @inheritDoc
     */
    public function mapToView(array $migrations): MigrationsListView
    {
        $migrationsList = new MigrationsListView();

        foreach ($migrations as $migration) {
            $migrationsList->addMigration($this->mapToSingleMigrationView($migration));
        }

        return $migrationsList;
    }

    private function mapToSingleMigrationView(Migration $migration): MigrationView
    {
        $view = new MigrationView($migration->getName(), $migration->getCreatedAt());

        if ($migration->hasDescription()) {
            $view->setDescription($migration->getDescription());
        }

        return $view;
    }
}
