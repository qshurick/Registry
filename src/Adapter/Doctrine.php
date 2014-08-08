<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 17:32
 */

namespace Registry\Adapter;


use Registry\Adapter\Doctrine\Exception\DoctrineAdapterDoesNotConfiguredException;
use Registry\Adapter\Doctrine\Registry;

class Doctrine implements AdapterInterface {
    /**
     * @param mixed $option
     * @param \Zend\Mvc\Application $application
     * @throws Doctrine\Exception\DoctrineAdapterDoesNotConfiguredException
     * @return \Registry\RegistryInterface
     */
    public function getInstance($option, \Zend\Mvc\Application $application = null) {
        try {
            /** @var \Doctrine\ORM\EntityManager $entityManager */
            $entityManager = $application->getServiceManager()->get('Doctrine\ORM\EntityManager');
            return new Registry($entityManager);
        } catch (\Exception $ex) {
            throw new DoctrineAdapterDoesNotConfiguredException("Doctrine adapter cannot be started", 0, $ex);
        }
    }

} 