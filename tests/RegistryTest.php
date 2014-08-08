<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 20:24
 */

namespace Registry\Tests;

use PHPUnit_Framework_TestCase;

class RegistryTest extends PHPUnit_Framework_TestCase {
    public static function setUpBeforeClass() {
        \Registry\Registry::setOption(array(
            'adapter' => '\Registry\Adapter\Dummy',
            'data' => array(
                '/core' => 'Hello, world',
                '/core/modules' => null,
                '/core/modules/auth' => null,
                '/core/modules/auth/property-1' => 'value 1',
                '/core/modules/auth/property-2' => 'value 2',
                '/core/modules/auth/property-3' => 'value 3',
            )
        ));
    }

    public function testRegistryIsAvailable() {
        $registry = \Registry\Registry::getRegistry();
        $this->assertNotNull($registry);
        $this->assertInstanceOf('\Registry\Adapter\Dummy', $registry);
    }

    public function testRegistryIsReadable() {
        $registry = \Registry\Registry::getRegistry();
        $value = $registry->getValueByPath('/core');

        $this->assertEquals('Hello, world', $value);
    }

    public function testRegistryWritable() {
        $registry = \Registry\Registry::getRegistry();
        $registry->setByPath('/core', 'Hi!');
        $value = $registry->getValueByPath('/core');

        $this->assertEquals('Hi!', $value);
    }


}
 