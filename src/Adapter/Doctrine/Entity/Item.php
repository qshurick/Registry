<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 9:41
 */

namespace Registry\Adapter\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Registry\Exception\ValueValidationException;

/**
 * Class Item
 * @package Registry\Entity
 * @ORM\Entity()
 * @ORM\Table(name="registry_items")
 */
class Item {

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true, name="parent_id")
     */
    protected $parentId;

    /**
     * @var Item|null
     * @ORM\OneToOne(targetEntity="Item")
     */
    protected $parent;

    /**
     * @var ArrayCollection|null
     * @ORM\OneToMany(targetEntity="Item", mappedBy="parent", fetch="LAZY")
     */
    protected $children;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @var int
     * @ORM\Column(name="type", type="integer")
     */
    protected $typeId;

    /**
     * @var Type
     * @ORM\OneToOne(targetEntity="Registry\Adapter\Doctrine\Entity\Type")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    protected $type;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $value;

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|null
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @return bool
     */
    public function hasChildren() {
        return $this->children !== null && !$this->children->isEmpty();
    }

    /**
     * @return bool
     */
    public function hasParent() {
        return $this->parent !== null;
    }

    /**
     * @return Item|null
     */
    public function getParent() {
        return $this->parent;
    }

    public function setValue($value) {
        if ($this->type->isValid($value)) {
            $this->value = trim($value);
        } else {
            throw new ValueValidationException("Invalid value '$value' for $this->type");
        }
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getParentId() {
        return $this->parentId;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return Type
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getTypeId() {
        return $this->typeId;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

}