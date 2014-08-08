<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 20:50
 */

return array(


    // 'registry' => array(
    //     'adapter' => '\Registry\Adapter\Doctrine'
    // ),

    /*'listeners' => array(
        'Register\Launcher'
    ),
    'service_manager' => array(
        'invokables' => array(
            'Register\Launcher' => 'Register\Launcher'
        )
    ),*/

    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'paths' => array(__DIR__ . '/../src/Adapter/Doctrine/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Registry\Adapter\Doctrine\Entity' => 'application_entities'
                )
            )
        )
    ),

);