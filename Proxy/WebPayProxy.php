<?php

namespace Polidog\WebPayBundle\Proxy;

use WebPay\AbstractData;
use WebPay\WebPay;

class WebPayProxy
{
    /**
     * @var WebPay
     */
    private $webPay;

    /**
     * WebPayProxy constructor.
     * @param WebPay $webPay
     */
    public function __construct(WebPay $webPay)
    {
        $this->webPay = $webPay;
    }

    /**
     * @param string $property
     * @param string $name
     * @param array $args
     * @return AbstractData
     */
    public function propertyMethodCall($property, $name, array $args)
    {
        return $this->webPay->{$property}->{$name}($args);
    }

}