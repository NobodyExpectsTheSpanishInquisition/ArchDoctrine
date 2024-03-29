<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class Id
{
    public function __construct(private string $id)
    {
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
