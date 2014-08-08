<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 17:18
 */

namespace Registry;

use Registry\Exception\RegistryDoesNotConfiguredException;
use Zend\Debug\Debug;

class Registry {

    /** @var RegistryInterface */
    protected static $instance;

    /**
     * @param array $options
     * @param \Zend\Mvc\Application $application
     * @throws Exception\RegistryDoesNotConfiguredException
     */
    public static function setOption($options, \Zend\Mvc\Application $application = null) {
        if (!isset($options['adapter']))
            throw new RegistryDoesNotConfiguredException("Adapter not found");
        $adapter = $options['adapter'];
        if (is_string($adapter)) {
            if (!is_subclass_of($adapter, '\Registry\Adapter\AdapterInterface'))
                throw new RegistryDoesNotConfiguredException("$adapter must be an instance of \\Registry\\Adapter\\AdapterInterface");
            $adapter = new $adapter();
            /** @var \Registry\Adapter\AdapterInterface $adapter */
            self::$instance = $adapter->getInstance($options, $application);
        } elseif ($adapter instanceof \Registry\Adapter\AdapterInterface) {
            self::$instance = $adapter->getInstance($options, $application);
        } else
            throw new RegistryDoesNotConfiguredException("Adapter not found (" . Debug::dump($adapter, null, false) .  ")");
    }

    /**
     * @return RegistryInterface
     * @throws RegistryDoesNotConfiguredException
     */
    public static function getRegistry() {
        if (static::$instance !== null) {
            return static::$instance;
        }
        throw new RegistryDoesNotConfiguredException();
    }
} 