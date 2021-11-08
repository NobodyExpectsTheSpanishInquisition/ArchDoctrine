<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\ValueObject\Id;
use Exception;

final class ProjectHasNotRegisteredMigrationsException extends Exception
{
    public static function get(Id $projectId): self
    {
        return new self(sprintf('Project: %s has not registered migrations.', (string) $projectId));
    }
}
