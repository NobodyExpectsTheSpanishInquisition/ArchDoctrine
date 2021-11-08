<?php

declare(strict_types=1);

namespace App\ListMigrations\Application;

use App\Shared\Domain\ValueObject\Id;

final class ListMigrationsQuery
{
    public function __construct(private Id $projectId)
    {
    }

    public function getProjectId(): Id
    {
        return $this->projectId;
    }
}
