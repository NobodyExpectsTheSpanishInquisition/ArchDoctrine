<?php

declare(strict_types=1);

namespace App\Shared\Domain\Provider;

use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\ValueObject\Id;

interface ProjectProviderInterface
{
    /**
     * @return Project[]
     */
    public function findAll(): array;

    /**
     * @throws \App\Shared\Domain\Exception\ProjectNotFoundException
     */
    public function getOne(Id $projectId): Project;
}
