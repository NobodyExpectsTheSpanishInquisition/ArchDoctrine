<?php

declare(strict_types=1);

namespace App\ListMigrations\Infrastructure;

final class MigrationFileFilterCriteria
{
    private const EXPECTED_EXTENSION = 'php';
    private const EXPECTED_PREFIX = 'Version';
    private const EXPECTED_BASENAME_LENGTH = 25;

    public static function getExpectedBasenameLength(): int
    {
        return self::EXPECTED_BASENAME_LENGTH;
    }

    public static function getExpectedExtension(): string
    {
        return self::EXPECTED_EXTENSION;
    }

    public static function getExpectedPrefix(): string
    {
        return self::EXPECTED_PREFIX;
    }
}
