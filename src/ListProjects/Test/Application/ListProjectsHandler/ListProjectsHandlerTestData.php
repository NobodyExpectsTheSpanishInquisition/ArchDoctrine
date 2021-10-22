<?php

declare(strict_types=1);

namespace App\ListProjects\Test\Application\ListProjectsHandler;

use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\ProjectName;
use Doctrine\ORM\EntityManagerInterface;

final class ListProjectsHandlerTestData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function loadProject(): void
    {
        $project = new Project(new Id('BFC5101E-4D6E-47C1-8960-822D2C59F7FB'), new ProjectName('TEST'));

        $this->entityManager->persist($project);

        $this->entityManager->flush();
    }
}
