<?php

declare(strict_types=1);

namespace App\ListMigrations\Infrastructure;

use SplFileInfo;

final class MigrationFileFilterCallback
{
    public static function get(): callable
    {
        return static function (SplFileInfo $file): bool {
            $isPhpFile = self::isPhpFile($file);
            $containsVersionPrefix = self::containsVersionPrefix($file);
            $hasBasenameCorrectLength = self::hasBasenameCorrectLength($file);

            return $isPhpFile && $containsVersionPrefix && $hasBasenameCorrectLength;
        };
    }

    private static function isPhpFile(SplFileInfo $file): bool
    {
        return $file->getExtension() === MigrationFileFilterCriteria::getExpectedExtension();
    }

    private static function containsVersionPrefix(SplFileInfo $file): bool
    {
        return str_starts_with($file->getBasename(), MigrationFileFilterCriteria::getExpectedPrefix());
    }

    private static function hasBasenameCorrectLength(SplFileInfo $file): bool
    {
        return strlen($file->getBasename()) === MigrationFileFilterCriteria::getExpectedBasenameLength();
    }
}
