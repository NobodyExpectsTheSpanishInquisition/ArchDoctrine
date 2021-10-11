<?php

declare(strict_types=1);

namespace App\Shared\Test\Infrastructure\Repository;

use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\ProjectName;
use Doctrine\ORM\EntityManagerInterface;

final class ProjectRepositoryTestData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function loadProject(): void
    {
        $this->entityManager->persist($this->getProject());

        $this->entityManager->flush();
    }

    public function getProject(): Project
    {
        return new Project($this->getId(), new ProjectName('Test Project'));
    }

    public function getId(): Id
    {
        return new Id('8B47594D-EED4-40B6-A8F6-C6EFE3DA3A0F');
    }
}
