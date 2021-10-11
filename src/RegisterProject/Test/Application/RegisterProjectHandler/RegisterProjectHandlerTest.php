<?php

declare(strict_types=1);

namespace App\RegisterProject\Test\Application\RegisterProjectHandler;

use App\RegisterProject\Application\RegisterProjectHandler;
use App\Shared\Application\Repository\ProjectRepositoryInterface;
use App\Shared\Test\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

final class RegisterProjectHandlerTest extends UnitTestCase
{
    private MockObject|ProjectRepositoryInterface $projectRepositoryMock;
    private RegisterProjectHandlerTestData $testData;

    public function test_ShouldSaveProject(): void
    {
        $this->projectRepositoryMock->expects(self::once())->method('save');
        $this->projectRepositoryMock->expects(self::once())->method('flush');

        $handler = new RegisterProjectHandler($this->projectRepositoryMock);

        $handler->handle($this->testData->getCommand());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RegisterProjectHandlerTestData();

        /** @var \PHPUnit\Framework\MockObject\MockObject|\App\Shared\Application\Repository\ProjectRepositoryInterface repository */
        $this->projectRepositoryMock = $this->createMock(ProjectRepositoryInterface::class);
    }
}
