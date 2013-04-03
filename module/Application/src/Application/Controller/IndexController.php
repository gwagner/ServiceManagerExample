<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Service\RandomNumber;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $this->verifyExampleDB();

        $model = $this->getServiceLocator()->get('model');
        $result = $model->addRandomRecord();

        # Default a history array
        $history = array();
        if(file_exists('/tmp/history')) # If we have a history file, read it in and explode it
            $history = explode("\n", trim(file_get_contents('/tmp/history')));

        $history = array_reverse($history);

        # save the contents of this result into history
        file_put_contents('/tmp/history', $result."\n", FILE_APPEND);

        # Return the view
        return new ViewModel(array('result' => $result, 'history' => $history));
    }

    public function carryObjectAction()
    {
        $result = array(
            'constructor' => array(
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
                new RandomNumber(),
            ),
            'service_manager' => array(
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
                $this->getServiceLocator()->get('random_number'),
            )

        );

        # Return the view
        return new ViewModel(array('result' => $result));
    }

    public function resetAction()
    {
        $this->verifyExampleDB();

        if(file_exists('/tmp/history')) # If we have a history file, remove it
            unlink('/tmp/history');

        $mongoConnector = new \Mongo();
        $db = new \MongoDB($mongoConnector, 'example');
        $collection = new \MongoCollection($db, 'example');
        $collection->drop();

        $mysqlConnector = new \mysqli('localhost', 'root', 'root', 'example');
        mysqli_query($mysqlConnector, 'TRUNCATE example');

        # Return the view
        return new ViewModel();
    }

    protected function verifyExampleDB()
    {
        $conn = $this->getServiceLocator()->get('mysql_connection');

        $result = mysqli_query($conn->getConnector(), 'show databases');

        $databases = array();
        while($row = mysqli_fetch_assoc($result))
            $databases[$row['Database']] = 1;

        if(!isset($databases['example']))
        {
            mysqli_query($conn->getConnector(), 'create database if not exists `example`');

            $conn->getConnector()->select_db('example');

            mysqli_query($conn->getConnector(), 'CREATE TABLE `example` (`result` varchar(20) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1');
        }
    }
}
