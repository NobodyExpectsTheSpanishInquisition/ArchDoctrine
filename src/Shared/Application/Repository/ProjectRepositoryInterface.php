<?php

declare(strict_types=1);

namespace App\Shared\Application\Repository;

use App\Shared\Domain\Entity\Project;

interface ProjectRepositoryInterface
{
    /**
     * @return Project[]
     */
    public function findAll(): array;

    public function flush(): void;

    public function save(Project $project): void;
}
