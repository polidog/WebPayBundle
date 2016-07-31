<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/07/31.
 */

namespace Polidog\WebPayBundle;

use Polidog\WebPayBundle\Proxy\PropertyBind;
use Polidog\WebPayBundle\Proxy\PropertyMethodProxy;
use WebPay\Account;
use WebPay\Charge;
use WebPay\Customer;
use WebPay\Event;
use WebPay\Recursion;
use WebPay\Shop;
use WebPay\Token;

/**
 * Class WebPayApi.
 *
 * @property Charge $charge
 * @property Customer $customer
 * @property Token $token
 * @property Event $event
 * @property Shop $shop
 * @property Recursion $recursion
 * @property Account $account
 */
class WebPayApi
{
    /**
     * @var PropertyMethodProxy
     */
    private $propertyMethodProxy;

    /**
     * WebPayApi constructor.
     *
     * @param PropertyMethodProxy $propertyMethodProxy
     */
    public function __construct(PropertyMethodProxy $propertyMethodProxy)
    {
        $this->propertyMethodProxy = $propertyMethodProxy;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->propertyMethodProxy->getWebPay(), $name], $arguments);
    }

    public function __get($name)
    {
        return new PropertyBind($this->propertyMethodProxy, $name);
    }
}
