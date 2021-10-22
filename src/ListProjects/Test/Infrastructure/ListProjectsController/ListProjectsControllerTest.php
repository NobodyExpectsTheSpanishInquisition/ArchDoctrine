<?php

declare(strict_types=1);

namespace App\ListProjects\Test\Infrastructure\ListProjectsController;

use App\Shared\Test\WebTestCase;

final class ListProjectsControllerTest extends WebTestCase
{
    public function test_ShouldReturnOkStatusCode(): void
    {
        $statusCode = $this->get('/api/projects')->getStatusCode();

        self::assertEquals(200, $statusCode);
    }
}
