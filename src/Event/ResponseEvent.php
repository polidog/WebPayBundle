<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31
 */

namespace Polidog\WebPayBundle\Event;


class ResponseEvent
{
    private $name;

    private $response;

    /**
     * ResponseEvent constructor.
     * @param $name
     * @param $response
     */
    public function __construct($name, $response)
    {
        $this->name = $name;
        $this->response = $response;
    }


}