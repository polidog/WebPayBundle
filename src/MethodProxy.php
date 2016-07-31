<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31
 */

namespace Polidog\WebPayBundle;


use Polidog\WebPayBundle\Event\ResponseEvent;
use Polidog\WebPayBundle\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use WebPay\WebPay;

class MethodProxy
{
    /**
     * @var WebPay
     */
    private $webPay;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * MethodWapper constructor.
     * @param WebPay $webPay
     */
    public function __construct(WebPay $webPay, EventDispatcherInterface $eventDispatcher)
    {
        $this->webPay = $webPay;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __call($name, $args)
    {
        $requestEvent = new RequestEvent($name, $args);
        $this->eventDispatcher->dispatch("{webpay.request.$name}", $requestEvent);

        $result = call_user_func_array([$this->webPay, $name],$args);

        $responseEvent = new ResponseEvent($name, $result);
        $this->eventDispatcher->dispatch("{webpay.response.$name}", $responseEvent);

        return $result;
    }
}