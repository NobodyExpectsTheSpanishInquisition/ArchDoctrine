<?php

declare(strict_types=1);

namespace App\ListMigrations\Test\Application\ListMigrationsHandler;

use App\ListMigrations\Application\ListMigrationsQuery;
use App\ListMigrations\Application\View\MigrationsListView;
use App\ListMigrations\Application\View\MigrationView;
use App\Shared\Domain\Model\Migration;
use App\Shared\Domain\ValueObject\Id;

final class ListMigrationsHandlerTestData
{
    public function getMigrationsListViewWithMigrationWithDescription(): MigrationsListView
    {
        $list = new MigrationsListView();

        $migrationView = $this->getMigrationViewWithDescription();

        $list->addMigration($migrationView);

        return $list;
    }

    private function getMigrationViewWithDescription(): MigrationView
    {
        $migration = $this->getMigrationWithDescription();

        $view = new MigrationView($migration->getName(), $migration->getCreatedAt());

        $view->setDescription($migration->getDescription());

        return $view;
    }

    public function getMigrationWithDescription(): Migration
    {
        $migration = $this->getMigration();

        $migration->addDescription($this->getDescription());

        return $migration;
    }

    public function getMigration(): Migration
    {
        return new Migration($this->getMigrationName(), $this->getMigrationDate());
    }

    public function getMigrationName(): string
    {
        return 'migration';
    }

    public function getMigrationDate(): string
    {
        return '01-01-2021';
    }

    public function getDescription(): string
    {
        return 'description';
    }

    public function getMigrationsListViewWithMigrationWithoutDescription(): MigrationsListView
    {
        $list = new MigrationsListView();

        $migrationView = $this->getMigrationViewWithoutDescription();

        $list->addMigration($migrationView);

        return $list;
    }

    private function getMigrationViewWithoutDescription(): MigrationView
    {
        $migration = $this->getMigrationWithDescription();

        return new MigrationView($migration->getName(), $migration->getCreatedAt());
    }

    public function getQuery(): ListMigrationsQuery
    {
        return new ListMigrationsQuery($this->getProjectId());
    }

    public function getProjectId(): Id
    {
        return new Id('CFD32B07-D0EF-49ED-A3BF-15F6D8C3B335');
    }
}
