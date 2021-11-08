<?php

declare(strict_types=1);

namespace App\ListMigrations\Application;

use App\ListMigrations\Application\View\MigrationsListView;
use App\Shared\Domain\Model\Migration;

interface MigrationsListMapperInterface
{
    /**
     * @param array<Migration> $migrations
     */
    public function mapToView(array $migrations): MigrationsListView;
}
