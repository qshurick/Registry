<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 16:58
 */

namespace Registry;

interface RegistryItem {
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getValue();

    /**
     * @param mixed $value
     * @throws \Registry\Exception\ValueValidationException
     */
    public function setValue($value);


    /**
     * @return bool
     */
    public function hasParent();

    /**
     * @return RegistryItem
     * @throws \Registry\Exception\RelatedItemDoesNotExistsException
     */
    public function getParent();

    /**
     * @return bool
     */
    public function hasChildren();

    /**
     * @return array
     * @throws \Registry\Exception\RelatedItemDoesNotExistsException
     */
    public function getChildren();

    /**
     * @return RegistryItemType
     */
    public function getType();
}