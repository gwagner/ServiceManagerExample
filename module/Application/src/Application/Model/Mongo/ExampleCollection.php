<?php

namespace Application\Model\Mongo;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;

class ExampleCollection implements ServiceLocatorAwareInterface, FactoryInterface
{
    use ServiceLocatorAwareTrait;

    /** @var \Application\Connector\Mongo */
    protected $_connector;

    /** @var \MongoDb */
    protected $_db;

    /** @var \MongoCollection */
    protected $_collection;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->_connector = $serviceLocator->get('connection');

        return $this;
    }

    public function addRandomRecord()
    {
        $value = $this->generateRandomString();

        $collection = $this->getCollection();

        $collection->insert(array('value' => $value));

        return 'Adding a new <span style="color: green">Mongo</span> Record <strong>'.$value.'</strong> through connectionId '.$this->_connector->getConnectionId();
    }

    /**
     * @return \MongoCollection
     */
    protected function getCollection()
    {
        if(!$this->_collection)
        {
            $this->_db = new \MongoDb($this->_connector->getConnector(), 'example');
            $this->_collection = new \MongoCollection($this->_db, 'example');
        }

        return $this->_collection;
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}