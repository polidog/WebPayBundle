<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/08/01.
 */

namespace Polidog\WebPayBundle\Controller;

use Polidog\WebPayBundle\Event\WebhookEvent;
use Polidog\WebPayBundle\WebPayEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use WebPay\Data\EventData;

class WebhookController
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var string
     */
    private $secretToken;

    /**
     * WebhookController constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param $secretToken
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, $secretToken)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->secretToken = $secretToken;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $this->checkCredential($request);

        $eventData = new EventData(json_decode($request->getContent(), true));
        $event = new WebhookEvent($eventData->type, $eventData);
        $this->eventDispatcher->dispatch(WebPayEvents::WEBHOOK, $event);

        return new Response();
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function checkCredential(Request $request)
    {
        if ($this->secretToken != $request->get('X-Webpay-Origin-Credential')) {
            throw new BadCredentialsException('Bad credential');
        }
    }
}
