<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 20:05
 */

namespace Registry\Adapter\Dummy;


use Registry\Exception\RelatedItemDoesNotExistsException;
use Registry\RegistryItem;
use Registry\RegistryItemType;

class Item implements RegistryItem {

    protected $id;
    protected $title;
    protected $description;
    protected $value;
    protected $parent;
    protected $children;
    protected $type;

    function __construct($id, $title, $value, $type, $description, $parent, $children) {
        $this->children = $children;
        $this->description = $description;
        $this->id = $id;
        $this->parent = $parent;
        $this->title = $title;
        $this->type = $type;
        $this->value = $value;
    }


    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @throws \Registry\Exception\ValueValidationException
     */
    public function setValue($value) {
        $this->value;
    }

    /**
     * @return bool
     */
    public function hasParent() {
        return $this->parent !== null;
    }

    /**
     * @return RegistryItem
     * @throws \Registry\Exception\RelatedItemDoesNotExistsException
     */
    public function getParent() {
        if ($this->hasParent())
            return $this->parent;
        throw new RelatedItemDoesNotExistsException();
    }

    /**
     * @return bool
     */
    public function hasChildren() {
        return $this->children !== null;
    }

    /**
     * @return array
     * @throws \Registry\Exception\RelatedItemDoesNotExistsException
     */
    public function getChildren() {
        if ($this->hasChildren())
            return $this->children;
        throw new RelatedItemDoesNotExistsException();
    }

    /**
     * @return RegistryItemType
     */
    public function getType() {
        return $this->type;
    }
}