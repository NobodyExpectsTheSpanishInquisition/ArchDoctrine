<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class ProjectName
{
    public function __construct(private string $name)
    {
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
