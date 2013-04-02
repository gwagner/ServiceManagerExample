<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gwagner
 * Date: 4/2/13
 * Time: 3:48 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Connector;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;

class Mongo implements ServiceLocatorAwareInterface, FactoryInterface
{
    use ServiceLocatorAwareTrait;

    /** @var \Mongo */
    protected $_connector;

    /** @var int */
    protected $_connectionId;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->_connector = new \Mongo();

        $this->_connectionId = mt_rand(0,200000);

        return $this;
    }

    /**
     * @return \Mongo
     */
    public function getConnector()
    {
        return $this->_connector;
    }

    /**
     * @return int
     */
    public function getConnectionId()
    {
        return $this->_connectionId;
    }
}