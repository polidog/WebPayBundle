<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31
 */

namespace Polidog\WebPayBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('polidog_webpay');
    }

}