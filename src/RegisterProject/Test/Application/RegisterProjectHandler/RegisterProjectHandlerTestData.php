<?php

declare(strict_types=1);

namespace App\RegisterProject\Test\Application\RegisterProjectHandler;

use App\RegisterProject\Application\RegisterProjectCommand;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\ProjectName;

final class RegisterProjectHandlerTestData
{
    public function getCommand(): RegisterProjectCommand
    {
        return new RegisterProjectCommand(
            new Id('3843D6FF-5CF8-4332-A8FA-1700162BB953'),
            new ProjectName('Test Project')
        );
    }
}
