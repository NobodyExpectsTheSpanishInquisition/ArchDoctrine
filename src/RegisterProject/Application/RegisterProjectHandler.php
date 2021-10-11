<?php

declare(strict_types=1);

namespace App\RegisterProject\Application;

use App\Shared\Application\Repository\ProjectRepositoryInterface;
use App\Shared\Domain\Entity\Project;

final class RegisterProjectHandler
{
    public function __construct(private ProjectRepositoryInterface $projectRepository)
    {
    }

    public function handle(RegisterProjectCommand $command): void
    {
        $project = new Project($command->getId(), $command->getName());

        $this->projectRepository->save($project);

        $this->projectRepository->flush();
    }
}
