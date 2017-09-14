<?php

namespace Beyerz\ApiAdapterBundle;

use Beyerz\ApiAdapterBundle\DependencyInjection\CompilerPass\ClientPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BeyerzApiAdapterBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ClientPass());
    }
}
