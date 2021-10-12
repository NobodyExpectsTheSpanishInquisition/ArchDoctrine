<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Shared\Domain\Entity\Project;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class EntityManagerFactory
{
    public function __construct(private ContainerInterface $container)
    {
    }

    public function create(): EntityManagerInterface
    {
        $cacheDir = $this->container->getParameter('kernel.cache_dir');

        $configuration = new Configuration();

        $configuration->setNamingStrategy(new UnderscoreNamingStrategy());
        $chain = new MappingDriverChain();
        $chain->addDriver(
            new AttributeDriver([AttributeDriver::class]),
            Project::class
        );

        $configuration->setMetadataDriverImpl($chain);
        $configuration->setProxyDir(
            $cacheDir . DIRECTORY_SEPARATOR
            . 'dev' . DIRECTORY_SEPARATOR
            . 'doctrine' . DIRECTORY_SEPARATOR
            . 'orm' . DIRECTORY_SEPARATOR
            . 'Proxies'
        );

        $configuration->setProxyNamespace('Proxies');
        $configuration->setEntityNamespaces(['App\Shared\Infrastructure\Entity']);
        $configuration->setAutoGenerateProxyClasses(true);

        $dbConnUrl = $_ENV['DATABASE_URL'];

        if (str_contains($dbConnUrl, '_test_test')) {
            $dbConnUrl = str_replace('_test_test', '_test', $dbConnUrl);
        }

        return EntityManager::create(['url' => $dbConnUrl], $configuration, new EventManager());
    }
}
