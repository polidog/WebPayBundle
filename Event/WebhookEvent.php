<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/08/01.
 */

namespace Polidog\WebPayBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use WebPay\Data\EventData;

class WebhookEvent extends Event
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var EventData
     */
    private $data;

    /**
     * WebhookEvent constructor.
     *
     * @param string    $type
     * @param EventData $data
     */
    public function __construct($type, EventData $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return EventData
     */
    public function getData()
    {
        return $this->data;
    }

}
