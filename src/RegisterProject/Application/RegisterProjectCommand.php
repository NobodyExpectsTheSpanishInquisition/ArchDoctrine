<?php

declare(strict_types=1);

namespace App\RegisterProject\Application;

use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\ProjectName;

final class RegisterProjectCommand
{
    public function __construct(private Id $id, private ProjectName $name)
    {
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): ProjectName
    {
        return $this->name;
    }
}
