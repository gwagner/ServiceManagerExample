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
        # 'connection'        => 'Application\Connector\MySQL',
        # 'model'             => 'Application\Model\MySQL\ExampleTable',

        # Mongo Example Connector
        'connection'       => 'Application\Connector\Mongo',
        'model'            => 'Application\Model\Mongo\ExampleCollection',

        # Random Number Example
        'random_number'     => 'Application\Service\RandomNumber'
    ],

    'shared' => [
        //'random_number' => false
    ]
];