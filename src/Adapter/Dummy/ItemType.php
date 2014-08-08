<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 20:10
 */

namespace Registry\Adapter\Dummy;


use Registry\Exception\TypeIsNotExtensible;
use Registry\RegistryItemType;

class ItemType implements RegistryItemType {

    protected $id;
    protected $title;
    protected $description;
    protected $meta;
    protected $values;

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
        $this->title;
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
    public function getMeta() {
        return $this->meta;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value) {
        return true;
    }

    /**
     * @return array
     */
    public function getMessages() {
        return array();
    }

    /**
     * @return array
     */
    public function getValues() {
        if ($this->meta != static::META_SIMPLE)
            return $this->values;
        return array();
    }

    /**
     * @param mixed $value
     * @throws \Registry\Exception\TypeIsNotExtensible
     */
    public function addValue($value) {
        if ($this->meta == static::META_SIMPLE)
            throw new TypeIsNotExtensible();
        $this->values[] = $value;
    }

} 