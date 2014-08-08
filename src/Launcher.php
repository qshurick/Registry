<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 20:56
 */

namespace Registry;


use Registry\Adapter\AdapterInterface;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class Launcher implements ListenerAggregateInterface {

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events) {
        $events->attach('bootstrap', array($this, 'loadRegistry'), 100);
    }

    public function loadRegistry(EventInterface $e) {
        /** @var \Zend\Mvc\Application $application */
        $application = $e->getTarget();
        $config = $application->getServiceManager()->get('Config');
        if (isset($config['registry'])) {
            Registry::setOption($config['registry'], $application);
        }
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events) { }
}