<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Application\Repository\ProjectRepositoryInterface;
use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\Exception\ProjectNotFoundException;
use App\Shared\Domain\Provider\ProjectProviderInterface;
use App\Shared\Domain\ValueObject\Id;
use Doctrine\ORM\EntityManagerInterface;

final class ProjectRepository implements ProjectRepositoryInterface, ProjectProviderInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('projects')
            ->from(Project::class, 'projects');

        return $qb->getQuery()->getResult();
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOne(Id $projectId): Project
    {
        $project = $this->entityManager->find(Project::class, (string) $projectId);

        if ($project === null) {
            throw ProjectNotFoundException::get($projectId);
        }

        return $project;
    }

    public function save(Project $project): void
    {
        $this->entityManager->persist($project);
    }
}
