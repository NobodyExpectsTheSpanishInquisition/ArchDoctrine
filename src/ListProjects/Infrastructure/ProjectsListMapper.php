<?php

declare(strict_types=1);

namespace App\ListProjects\Infrastructure;

use App\ListProjects\Application\ProjectsListView;
use App\Shared\Domain\Entity\Project;

final class ProjectsListMapper
{
    /**
     * @param Project[] $projects
     */
    public function mapToView(array $projects): ProjectsListView
    {
        $projectsView = new ProjectsListView();

        foreach ($projects as $project) {
            $projectsView->add($project->getId(), $project->getName());
        }

        return $projectsView;
    }
}
