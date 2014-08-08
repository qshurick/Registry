<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 17:33
 */

namespace Registry\Adapter\Doctrine;


use Logger\Logger;
use Registry\Exception\PathNotFoundException;
use Registry\RegistryInterface;
use Zend\Debug\Debug;

class Registry implements RegistryInterface {

    /** @var  \Doctrine\ORM\EntityManager */
    protected $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $path
     * @return \Registry\Adapter\Doctrine\Entity\Item
     * @throws PathNotFoundException
     */
    private function _getByPath($path) {
        $repository = $this->entityManager->getRepository('\Registry\Adapter\Doctrine\Entity\Registry');
        /** @var \Registry\Adapter\Doctrine\Entity\Registry $registry */
        $registry = $repository->findOneBy(array(
            'path' => $path
        ));
        if ($registry === null) {
            Logger::getLogger('registry')->notice("Path '$path' not found");
            throw new PathNotFoundException("Path '$path' not found");
        }
        Logger::getLogger('registry')->debug("Someone found something on '$path'");
        Logger::getLogger('registry')->debug(Debug::dump(array(
            'id' => $registry->getId(),
            'value' => $registry->getValue(),
            'children' => $registry->getItem()->hasChildren() ? $registry->getItem()->getChildren()->count() : 'none'
        ), null, false));
        return $registry->getItem();
    }

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @throws \Registry\Exception\PathNotFoundException
     * @return \Registry\RegistryItem
     */
    public function getByPath($path) {
        $item = $this->_getByPath($path);
        return new Item($item);
    }

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @param string $value Before save value will validated with Item's type validators
     */
    public function setByPath($path, $value) {
        $item = $this->_getByPath($path);

        try {
            $item->setValue($value);
        } catch (\Exception $ex) {
            Logger::getLogger('registry')->notice("Value '" . Debug::dump($value, null, false) . "' wasn't set in path '$path'", array("exception" => $ex));
            throw $ex;
        }

        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }

    /**
     * @param string $path Path with leading "/" and without ending "/"
     * @return string
     */
    public function getValueByPath($path) {
        $item = $this->_getByPath($path);
        return $item->getValue();
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
        $item = $this->_getByPath($path);
        $values = $this->collectChildrenValues($item, $maxDepth);

        if (!is_array($values)) {
            return array(
                static::DEFAULT_VALUE => $values
            );
        }
        return $values;
    }

    /**
     * @param \Registry\Adapter\Doctrine\Entity\Item $item
     * @param int $maxDepth
     * @return array
     */
    protected function collectChildrenValues($item, $maxDepth) {
        $values = array();
        if ($item->hasChildren()) {
            $values[static::DEFAULT_VALUE] = $item->getValue();
            if ($maxDepth <= 0) {
                $values[static::MAX_DEPTH_MARK] = true;
                return $values;
            }
            /** @var \Registry\Adapter\Doctrine\Entity\Item $child */
            foreach ($item->getChildren() as $child) {
                $values[$child->getTitle()] = $this->collectChildrenValues($child, $maxDepth - 1);
            }
        } else {
            return $item->getValue();
        }
        return $values;
    }

} 