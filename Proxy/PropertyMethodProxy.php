<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31.
 */

namespace Polidog\WebPayBundle\Proxy;

use Polidog\WebPayBundle\Event\ResponseEvent;
use Polidog\WebPayBundle\Event\RequestEvent;
use Polidog\WebPayBundle\WebPayEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use WebPay\AbstractData;
use WebPay\WebPay;

class PropertyMethodProxy
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
     *
     * @param WebPay $webPay
     */
    public function __construct(WebPay $webPay, EventDispatcherInterface $eventDispatcher)
    {
        $this->webPay = $webPay;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return WebPay
     */
    public function getWebPay()
    {
        return $this->webPay;
    }

    /**
     * @param $property
     * @param $name
     * @param array $args
     *
     * @return mixed
     */
    public function call($property, $name, array $args)
    {
        $this->fireRequestEvent($property, $name, $args);
        $response = $this->webPay->{$property}->{$name}($args);
        $this->fireResponseEvent($property, $name, $response);

        return $response;
    }

    /**
     * @param $property
     * @param $name
     * @param array $args
     */
    private function fireRequestEvent($property, $name, array $args)
    {
        $requestEvent = new RequestEvent($property, $name, $args);
        $this->eventDispatcher->dispatch(WebPayEvents::REQUEST, $requestEvent);
    }

    /**
     * @param $property
     * @param $name
     * @param AbstractData $response
     */
    private function fireResponseEvent($property, $name, AbstractData $response)
    {
        $responseEvent = new ResponseEvent($property, $name, $response);
        $this->eventDispatcher->dispatch(WebPayEvents::RESPONSE, $responseEvent);
    }
}
