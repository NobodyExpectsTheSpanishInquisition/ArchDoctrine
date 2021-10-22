<?php

declare(strict_types=1);

namespace App\ListProjects\Application;

interface ProjectsListProviderInterface
{
    public function provide(): ProjectsListView;
}
