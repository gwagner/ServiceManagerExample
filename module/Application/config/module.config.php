<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'reset' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/reset',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'Reset',
                    ),
                ),
            ),
            'carryObject' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/carry-object',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'CarryObject',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => require dirname(__FILE__).'/service_manager.config.php',
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
