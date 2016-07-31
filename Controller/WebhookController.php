<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/08/01
 */

namespace Polidog\WebPayBundle\Controller;


use Polidog\WebPayBundle\Event\WebhookEvent;
use Polidog\WebPayBundle\WebPayEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WebPay\Data\EventData;

class WebhookController
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * WebhookController constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $eventData = new EventData(json_decode($request->getContent(), true));
        $event = new WebhookEvent($eventData->type, $eventData);
        $this->eventDispatcher->dispatch(WebPayEvents::WEBHOOK, $event);

        return new Response();
    }
}