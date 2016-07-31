<?php

namespace Polidog\WebPayBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PolidogWebPayBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterListenersPass('event_dispatcher', 'poildog_web_pay.event_listener', 'poildog_web_pay.event_subscriber'));
    }
}
