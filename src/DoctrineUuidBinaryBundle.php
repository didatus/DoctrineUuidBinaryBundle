<?php

namespace Didatus\DoctrineUuidBinary;

use Didatus\DoctrineUuidBinary\DependencyInjection\DoctrineUuidBinaryExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DoctrineUuidBinaryBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new DoctrineUuidBinaryExtension();
    }
}
