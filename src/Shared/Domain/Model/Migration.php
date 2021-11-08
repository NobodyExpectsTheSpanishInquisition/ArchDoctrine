<?php

declare(strict_types=1);

namespace App\Shared\Domain\Model;

final class Migration
{
    private ?string $description = null;

    public function __construct(private string $name, private string $createdAt)
    {
    }

    public function addDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function hasDescription(): bool
    {
        return $this->description !== null;
    }
}
