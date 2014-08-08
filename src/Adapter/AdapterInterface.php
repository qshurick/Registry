<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 17:28
 */

namespace Registry\Adapter;


use Zend\EventManager\EventInterface;

interface AdapterInterface {

    /**
     * @param mixed $options
     * @param \Zend\Mvc\Application $application
     * @return \Registry\RegistryInterface
     */
    public function getInstance($options, \Zend\Mvc\Application $application = null);

} 