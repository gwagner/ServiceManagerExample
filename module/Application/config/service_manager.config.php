<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gwagner
 * Date: 4/2/13
 * Time: 3:53 PM
 * To change this template use File | Settings | File Templates.
 */

return [
    'factories' => [
        'translator'        => 'Zend\I18n\Translator\TranslatorServiceFactory',

        # MySQL Example Connector
        'connection'        => 'Application\Connector\MySQL',
        'model'             => 'Application\Model\MySQL\ExampleTable',

        # Mongo Example Connector
        # 'connection'       => 'Application\Connector\Mongo',
        # 'model'            => 'Application\Model\Mongo\ExampleCollection',

        # Random Number Example
        'random_number'     => 'Application\Service\RandomNumber',

        # Since mysql does not create tables on fly like mongo, this connection is used to verify table creation
        'mysql_connection'  => 'Application\Connector\MySQL',
    ],

    'shared' => [
        //'random_number' => false
    ]
];