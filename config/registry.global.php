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

    'listener' => array(
        'Register\Launcher'
    ),
    'service_manager' => array(
        'invokables' => array(
            'Register\Launcher' => 'Register\Launcher'
        )
    ),

);