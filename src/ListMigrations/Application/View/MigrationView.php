<?php

declare(strict_types=1);

namespace App\ListMigrations\Application\View;

use JsonSerializable;

class MigrationView implements JsonSerializable
{
    private ?string $description = null;

    public function __construct(private string $name, private string $createdAt)
    {
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
