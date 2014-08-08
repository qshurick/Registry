<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 19:00
 */

namespace Registry\Adapter\Doctrine;


use Registry\Exception\RelatedItemDoesNotExistsException;
use Registry\RegistryItem;
use Registry\RegistryItemType;

class Item implements RegistryItem {

    /** @var \Registry\Adapter\Doctrine\Entity\Item */
    protected $item;

    public function __construct($item) {
        $this->item = $item;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->item->getId();
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->item->getTitle();
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
        return $this->item->getDescription();
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
    public function getValue() {
        return $this->item->getValue();
    }

    /**
     * @param mixed $value
     * @throws \Registry\Exception\ValueValidationException
     */
    public function setValue($value) {
        $this->item->setValue($value);
    }

    /**
     * @return bool
     */
    public function hasParent() {
        return $this->item->hasParent();
    }

    /**
     * @return RegistryItem
     * @throws \Registry\Exception\RelatedItemDoesNotExistsException
     */
    public function getParent() {
        $parent = $this->item->getParent();
        if ($parent == null)
            throw new RelatedItemDoesNotExistsException();
        return new Item($parent);
    }

    /**
     * @return bool
     */
    public function hasChildren() {
        return $this->item->hasChildren();
    }

    /**
     * @return array
     * @throws \Registry\Exception\RelatedItemDoesNotExistsException
     */
    public function getChildren() {
        $children = array();
        if (!$this->hasChildren()) {
            throw new RelatedItemDoesNotExistsException();
        }
        foreach ($this->item->getChildren() as $child) {
            $children[] = new Item($child);
        }
        return $children;
    }

    /**
     * @return RegistryItemType
     */
    public function getType() {
        // TODO: Implement getType() method.
    }


} 