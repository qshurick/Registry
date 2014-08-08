<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 19:33
 */

namespace Registry\Adapter\Doctrine;


use Registry\RegistryItemType;

class ItemType implements RegistryItemType {

    /** @var \Registry\Adapter\Doctrine\Entity\Type */
    protected $itemType;

    public function __construct($itemType) {
        $this->itemType = $itemType;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->itemType->getId();
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->itemType->getTitle();
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        // TODO: Implement setTitle() method.
    }

    /**
     * @return string
     */
    public function getDescription() {
        // TODO: Implement getDescription() method.
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        // TODO: Implement setDescription() method.
    }

    /**
     * @return string
     */
    public function getMeta() {
        return $this->itemType->getMeta();
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value) {
        return $this->itemType->isValid($value);
    }

    /**
     * @return array
     */
    public function getMessages() {
        // TODO: Implement getMessages() method.
        return array();
    }

    /**
     * @return array
     */
    public function getValues() {
        $collection = $this->itemType->getAvailableValues();
        $values = array();
        /** @var \Registry\Adapter\Doctrine\Entity\TypeValue $value */
        foreach ($collection as $value) {
            $values[] = $value->getValue();
        }
        return $values;
    }

    /**
     * @param mixed $value
     * @throws \Registry\Exception\TypeIsNotExtensible
     */
    public function addValue($value) {
        // TODO: Implement addValue() method.
    }


} 