<?php
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
     * @var WebPayProxy
     */
    private $webPayProxy;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * PropertyMethodProxy constructor.
     * @param WebPayProxy $webPayProxy
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(WebPayProxy $webPayProxy, EventDispatcherInterface $eventDispatcher)
    {
        $this->webPayProxy = $webPayProxy;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param $property
     * @param $name
     * @param array $args
     *
     * @return AbstractData
     */
    public function call($property, $name, array $args)
    {
        $this->fireRequestEvent($property, $name, $args);
        $response = $this->webPayProxy->propertyMethodCall($property, $name, $args);
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
