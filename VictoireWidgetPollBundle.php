<?php

namespace Victoire\Widget\PollBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Victoire\Widget\PollBundle\DependencyInjection\Compiler\PollQuestionCompilerPass;

class VictoireWidgetPollBundle extends Bundle
{
    /**
     * Build bundle.
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new PollQuestionCompilerPass());
    }
}
