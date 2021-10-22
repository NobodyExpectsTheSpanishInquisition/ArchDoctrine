<?php

declare(strict_types=1);

namespace App\ListProjects\Application;

final class ListProjectsHandler
{
    public function __construct(private ProjectsListProviderInterface $provider)
    {
    }

    public function handle(): ProjectsListView
    {
        return $this->provider->provide();
    }
}
