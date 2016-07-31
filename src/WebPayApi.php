<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31
 */

namespace Polidog\WebPayBundle;


class WebPayApi
{
    /**
     * @var MethodProxy
     */
    private $methodProxy;

    /**
     * WebPayProxy constructor.
     * @param MethodProxy $methodProxy
     */
    public function __construct(MethodProxy $methodProxy)
    {
        $this->methodProxy = $methodProxy;
    }

    public function __get($name)
    {
        return $this->methodProxy;
    }

}