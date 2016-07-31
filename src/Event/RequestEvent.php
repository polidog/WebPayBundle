<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31
 */

namespace Polidog\WebPayBundle\Event;


class RequestEvent
{
    private $name;

    private $args;

    /**
     * WebPayRequestEvent constructor.
     * @param $name
     * @param $args
     */
    public function __construct($name, $args)
    {
        $this->name = $name;
        $this->args = $args;
    }


}