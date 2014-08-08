<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 17:02
 */

namespace Registry;


interface RegistryItemType {

    const META_SIMPLE = 'simple';
    const META_LIST = 'list';
    const META_SET = 'set';

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
    public function getMeta();

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value);

    /**
     * @return array
     */
    public function getMessages();

    /**
     * @return array
     */
    public function getValues();

    /**
     * @param mixed $value
     * @throws \Registry\Exception\TypeIsNotExtensible
     */
    public function addValue($value);

} 