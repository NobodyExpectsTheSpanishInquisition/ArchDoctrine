<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Application\Repository\ProjectRepositoryInterface;
use App\Shared\Domain\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

final class ProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function save(Project $project): void
    {
        $this->entityManager->persist($project);
    }
}
