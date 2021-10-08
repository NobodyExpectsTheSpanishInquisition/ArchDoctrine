<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Entity;

use App\Shared\Application\ValueObject\Id;
use App\Shared\Application\ValueObject\ProjectName;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'project')]
final class Project
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    public function __construct(Id $id, ProjectName $name)
    {
        $this->id = (string) $id;
        $this->name = (string) $name;
    }
}
