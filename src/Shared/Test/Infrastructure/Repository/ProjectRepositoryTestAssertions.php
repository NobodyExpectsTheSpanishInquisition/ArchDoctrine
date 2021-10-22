<?php

declare(strict_types=1);

namespace App\Shared\Test\Infrastructure\Repository;

use App\Shared\Domain\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

final class ProjectRepositoryTestAssertions
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ProjectRepositoryTestData $testData,
        private ProjectRepositoryTest $testCase
    ) {
    }

    /**
     * @param Project[] $projects
     */
    public function assertNoProjectsReturned(array $projects): void
    {
        $this->testCase::assertCount(0, $projects);
    }

    public function assertProjectWasSavedInDatabase(): void
    {
        $project = $this->entityManager->find(Project::class, (string) $this->testData->getId());

        $this->testCase::assertNotNull($project);
    }

    /**
     * @param Project[] $projects
     */
    public function assertProjectsReturned(array $projects): void
    {
        $this->testCase::assertGreaterThan(0, $projects);

        foreach ($projects as $project) {
            $this->testCase::assertInstanceOf(Project::class, $project);
        }
    }
}
