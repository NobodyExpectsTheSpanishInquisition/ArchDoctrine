<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class MigrationsFolderPath
{
    public function __construct(private string $migrationsFolderPath)
    {
    }

    public function __toString(): string
    {
        return $this->migrationsFolderPath;
    }
}
