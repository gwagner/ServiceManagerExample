<?php

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;

class RandomNumber implements ServiceLocatorAwareInterface, FactoryInterface
{
    use ServiceLocatorAwareTrait;

    /** @var int */
    protected $randomNumber;

    public function __construct()
    {
        $this->randomNumber = mt_rand(0,200000);
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $randomNumber = new RandomNumber();
        $randomNumber->setServiceLocator($serviceLocator);

        return $randomNumber;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->randomNumber;
    }
}