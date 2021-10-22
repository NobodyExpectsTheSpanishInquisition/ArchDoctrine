<?php

declare(strict_types=1);

namespace App\ListProjects\Test\Infrastructure\ProjectsListMapper;

use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\ProjectName;

final class ProjectsListMapperTestData
{
    /**
     * @return Project[]
     */
    public function getProjects(): array
    {
        return [
            $this->getProjectOne(),
            $this->getProjectTwo(),
        ];
    }

    private function getProjectOne(): Project
    {
        return new Project(new Id($this->getProjectOneId()), new ProjectName($this->getProjectOneName()));
    }

    public function getProjectOneId(): string
    {
        return 'CD9D359F-1E4D-441B-AEBD-D5F7625E1F8F';
    }

    public function getProjectOneName(): string
    {
        return 'Project One';
    }

    private function getProjectTwo(): Project
    {
        return new Project(new Id($this->getProjectTwoId()), new ProjectName($this->getProjectTwoName()));
    }

    public function getProjectTwoId(): string
    {
        return '3B63DD17-068A-46D1-A825-6EBB6CD79C41';
    }

    public function getProjectTwoName(): string
    {
        return 'Project Two';
    }
}
