<?php

declare(strict_types=1);

namespace App\Shared\Test;

use LogicException;
use ReflectionClass;
use ReflectionException;

final class PrivatePropertiesAccessor
{
    public function getProperty(object $object, string $propertyName): mixed
    {
        $reflectedObject = new ReflectionClass($object);

        try {
            $reflectedProperty = $reflectedObject->getProperty($propertyName);
        } catch (ReflectionException $e) {
            throw new LogicException($e->getMessage());
        }

        $reflectedProperty->setAccessible(true);

        return $reflectedProperty->getValue($object);
    }
}
