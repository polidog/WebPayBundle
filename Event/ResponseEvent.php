<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31.
 */

namespace Polidog\WebPayBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use WebPay\AbstractData;

class ResponseEvent extends Event
{
    /**
     * @var string
     */
    private $property;

    /**
     * @var string
     */
    private $name;

    /**
     * @var AbstractData
     */
    private $response;

    /**
     * ResponseEvent constructor.
     *
     * @param string       $property
     * @param string       $name
     * @param AbstractData $response
     */
    public function __construct($property, $name, AbstractData $response)
    {
        $this->property = $property;
        $this->name = $name;
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return AbstractData
     */
    public function getResponse()
    {
        return $this->response;
    }

}
