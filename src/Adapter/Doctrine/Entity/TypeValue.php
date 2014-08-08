<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 9:46
 */

namespace Registry\Adapter\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Registry\Exception\ValueValidationException;

/**
 * Class TypeValue
 * @package Register\Entity
 * @ORM\Entity
 * @ORM\Table(name="registry_type_values")
 */
class TypeValue {
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @var int
     * @ORM\Column(type="integer", name="type")
     */
    protected $typeId;

    /**
     * @var Type
     *
     * @ORM\OneToOne(targetEntity="Registry\Adapter\Doctrine\Entity\Type")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    protected $type;
    /**
     * @var string|mixed
     * @ORM\Column(type="string")
     */
    protected $value;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $order;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $order
     */
    public function setOrder($order) {
        $this->order = $order;
    }

    /**
     * @return int
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * @param Type $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return Type
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed|string $value
     * @throws \Registry\Exception\ValueValidationException
     */
    public function setValue($value) {
        if ($this->type->isValid($value)) {
            $this->value = $value;
        } else {
            throw new ValueValidationException("Invalid value '$value' for $this->type");
        }
    }

    /**
     * @return mixed|string
     */
    public function getValue() {
        return $this->value;
    }



}