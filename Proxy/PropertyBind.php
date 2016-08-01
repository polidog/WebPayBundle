<?php
namespace Polidog\WebPayBundle\Proxy;

/**
 * Class PropertyBind.
 */
class PropertyBind
{
    /**
     * @var PropertyMethodProxy
     */
    private $propertyMethodProxy;

    /**
     * @var string
     */
    private $property;

    /**
     * PropertyBind constructor.
     *
     * @param PropertyMethodProxy $propertyMethodProxy
     * @param string              $property
     */
    public function __construct(PropertyMethodProxy $propertyMethodProxy, $property)
    {
        $this->propertyMethodProxy = $propertyMethodProxy;
        $this->property = $property;
    }

    public function __call($name, $arguments)
    {
        return $this->propertyMethodProxy->call($this->property, $name, $arguments);
    }

}
