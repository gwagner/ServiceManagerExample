<?php

namespace Application\Model\MySQL;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;

class ExampleTable implements ServiceLocatorAwareInterface, FactoryInterface
{
    use ServiceLocatorAwareTrait;

    /** @var \Application\Connector\MySQL */
    protected $_connector;

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

        mysqli_query($this->_connector->getConnector(), 'INSERT INTO example (result) VALUES ("'.mysql_real_escape_string($value).'")');

        return 'Adding a new <span style="color: red">MySQL</span> Record <strong>'.$value.'</strong> through connectionId '.$this->_connector->getConnectionId();
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