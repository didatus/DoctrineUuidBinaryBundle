<?php

namespace Didatus\DoctrineUuidBinary\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class DoctrineUuidBinaryExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container) { }

    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('doctrine', [
            'dbal' => [
                'types' => [
                    'uuid' => 'Didatus\DoctrineUuidBinary\Types\UuidType'
                ]
            ],
            'orm' => [
                'dql' => [
                    'string_functions' => [
                        'uuid_to_bin' => 'Didatus\DoctrineUuidBinary\Dql\UuidToBin'
                    ]
                ]
            ]
        ]);
    }
}
