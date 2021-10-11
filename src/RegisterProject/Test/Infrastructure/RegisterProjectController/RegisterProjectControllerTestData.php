<?php

declare(strict_types=1);

namespace App\RegisterProject\Test\Infrastructure\RegisterProjectController;

use App\Shared\Domain\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

final class RegisterProjectControllerTestData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function deleteRegisteredProject(): void
    {
        $project = $this->entityManager->find(Project::class, $this->getId());

        $this->entityManager->remove($project);
        $this->entityManager->flush();
    }

    private function getId(): string
    {
        return 'DC230F20-3C21-4AB4-B304-38AADAB8936C';
    }

    /**
     * @return array<string, string>
     */
    public function getData(): array
    {
        return [
            'id' => $this->getId(),
            'name' => 'Test Project',
        ];
    }

    public function getUri(): string
    {
        return '/api/project';
    }
}
