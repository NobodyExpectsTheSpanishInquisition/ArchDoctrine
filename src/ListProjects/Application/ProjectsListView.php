<?php

declare(strict_types=1);

namespace App\ListProjects\Application;

use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\ProjectName;

final class ProjectsListView
{
    /** @var array<int, string[]> */
    private array $projects = [];

    public function add(Id $id, ProjectName $name): void
    {
        $this->projects[] = ['id' => (string) $id, 'name' => (string) $name];
    }
}
