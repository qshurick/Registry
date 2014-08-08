<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 22:57
 */

namespace Registry;


use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements
    ConfigProviderInterface,
    BootstrapListenerInterface {
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig() {
        return require __DIR__ . '/../config/registry.global.php';
    }

    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e) {
        /** @var \Zend\Mvc\Application $application */
        $application = $e->getTarget();
        $config = $application->getServiceManager()->get('Config');
        if (isset($config['registry'])) {
            Registry::setOption($config['registry'], $application);
        }
    }
}