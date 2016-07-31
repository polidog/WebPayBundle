<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31.
 */

namespace Polidog\WebPayBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class RequestEvent extends Event
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
     * @var array
     */
    private $args;

    /**
     * RequestEvent constructor.
     *
     * @param $property
     * @param $name
     * @param array $args
     */
    public function __construct($property, $name, array $args)
    {
        $this->property = $property;
        $this->name = $name;
        $this->args = $args;
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
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }

}
