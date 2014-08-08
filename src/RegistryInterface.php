<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 16:38
 */

namespace Registry;

interface RegistryInterface {

    const DEFAULT_VALUE = "_defaultValue";
    const DEFAULT_DEPTH = 99;
    const MAX_DEPTH_MARK = "_maxDepthReached";

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @throws \Registry\Exception\PathNotFoundException
     * @return \Registry\RegistryItem
     */
    public function getByPath($path);

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @param string $value Before save value will validated with Item's type validators
     */
    public function setByPath($path, $value);

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @return string
     */
    public function getValueByPath($path);

    /**
     * @param string $path     Path with leading "/" and without ending "/"
     * @param int    $maxDepth
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
    public function getValuesByPath($path, $maxDepth = self::DEFAULT_DEPTH);
} 