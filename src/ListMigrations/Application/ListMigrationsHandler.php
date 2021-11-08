<?php

declare(strict_types=1);

namespace App\ListMigrations\Application;

use App\ListMigrations\Application\View\MigrationsListView;
use App\ListMigrations\Domain\ProjectMigrationsProviderInterface;
use App\Shared\Application\Exception\UnprocessableEntityException;
use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\Exception\ProjectHasNotRegisteredMigrationsException;
use App\Shared\Domain\Exception\ProjectNotFoundException;
use App\Shared\Domain\Model\Migration;
use App\Shared\Domain\Provider\ProjectProviderInterface;
use App\Shared\Domain\ValueObject\Id;
use LogicException;

final class ListMigrationsHandler
{
    public function __construct(
        private ProjectMigrationsProviderInterface $projectMigrationsProvider,
        private ProjectProviderInterface $projectProvider,
        private MigrationsListMapperInterface $migrationsListMapper
    ) {
    }

    public function handle(ListMigrationsQuery $query): MigrationsListView
    {
        $project = $this->provideProject($query->getProjectId());

        $migrations = $this->fetchMigrations($project);

        return $this->migrationsListMapper->mapToView($migrations);
    }

    private function provideProject(Id $getProjectId): Project
    {
        try {
            return $this->projectProvider->getOne($getProjectId);
        } catch (ProjectNotFoundException $e) {
            throw new LogicException($e->getMessage());
        }
    }

    /**
     * @return array<Migration>
     */
    private function fetchMigrations(Project $project): array
    {
        try {
            return $project->fetchMigrations($this->projectMigrationsProvider);
        } catch (ProjectHasNotRegisteredMigrationsException $e) {
            throw new UnprocessableEntityException($e->getMessage());
        }
    }
}
