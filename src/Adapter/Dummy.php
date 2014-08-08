<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 19:59
 */

namespace Registry\Adapter;


use Registry\Exception\PathNotFoundException;
use Registry\RegistryInterface;

class Dummy implements RegistryInterface, AdapterInterface {

    public static $storage = array();

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @throws \Registry\Exception\PathNotFoundException
     * @return \Registry\RegistryItem
     */
    public function getByPath($path) {
        // TODO: Implement getByPath() method.
    }

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @param string $value Before save value will validated with Item's type validators
     */
    public function setByPath($path, $value) {
        static::$storage[$path] = $value;
    }

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @return string
     */
    public function getValueByPath($path) {
        if (isset(static::$storage[$path])) {
            return static::$storage[$path];
        }
        throw new PathNotFoundException($path);
    }

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @param int $maxDepth
     * @return array
     *
     * @example
     *  Registry::getValuesByPath('/some/path');
     *  array(2) {
     *      ["_defaultValue"] => string(24) 'Value of /some/path Item'
     *      ["auth"] => array(4) {
     *          ["_defaultValue"] => NULL
     *          ["some-property"] => string(10) "some-value"
     *          ["some-property-2"] => string(10) "some-value"
     *          ["some-property-3"] => string(10) "some-value"
     *      }
     *  }
     *
     *  If Item doesn't have children its value set as is array( ItemTitle => ItemValue ),
     *  Otherwise Item's value sets in property with Registry::DEFAULT_VALUE name:
     *      array( Registry::DEFAULT_VALUE => ItemValue, firstChildTitle => ... )
     */
    public function getValuesByPath($path, $maxDepth = self::DEFAULT_DEPTH) {
        // TODO: Implement getValuesByPath() method.
    }


    /**
     * @param mixed $options
     * @param \Zend\Mvc\Application $application
     * @return \Registry\RegistryInterface
     */
    public function getInstance($options, \Zend\Mvc\Application $application = null) {
        if (isset($options['data'])) {
            foreach ($options['data'] as $path => $value) {
                $this->setByPath($path, $value);
            }
        }
        return $this;
    }
}