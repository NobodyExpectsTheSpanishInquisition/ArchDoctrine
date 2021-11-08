<?php

declare(strict_types=1);

namespace App\Shared\Test\Domain\Entity\Project;

use App\Shared\Domain\Entity\Project;
use App\Shared\Domain\Model\Migration;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\MigrationsFolderPath;
use App\Shared\Domain\ValueObject\ProjectName;

final class ProjectTestData
{
    /**
     * @return \App\Shared\Domain\Model\Migration[]
     */
    public function getArrayOfMigrations(): array
    {
        return [$this->getMigration()];
    }

    public function getMigration(): Migration
    {
        return new Migration('migration', '01-01-2021');
    }

    public function getMigrationsFolderPath(): MigrationsFolderPath
    {
        return new MigrationsFolderPath('/');
    }

    public function getProject(): Project
    {
        return new Project(new Id('058C85E2-4FA5-4441-90AD-69F1EEAC05F7'), new ProjectName('test'));
    }
}
