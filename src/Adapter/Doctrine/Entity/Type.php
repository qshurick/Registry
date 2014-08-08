<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 9:45
 */

namespace Registry\Adapter\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Logger\Logger;

/**
 * Class Type
 * @package Registry\Entity
 * @ORM\Entity
 * @ORM\Table(name="registry_types")
 */
class Type {

    const META_SIMPLE = 'simple';
    const META_LIST = 'list';
    const META_SET = 'set';

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $title;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $meta;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $validators;

    /**
     * @var ArrayCollection(TypeValue)
     * @ORM\OneToMany(targetEntity="Registry\Adapter\Doctrine\Entity\TypeValue", mappedBy="type", fetch="LAZY")
     *
     */
    protected $availableValues;

    public function __construct() {
        $this->availableValues = new ArrayCollection();
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
    public function getMeta() {
        return $this->meta;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getValidators() {
        return $this->validators;
    }

    /**
     * @return \Doctrine\ORM\PersistentCollection
     */
    public function getAvailableValues() {
        return $this->availableValues;
    }

    public function isValid($value) {
        if ($this->id === null)
            return false;
        $value = trim($value);

        // TODO: this stuff want to be tested!
        if ($this->validators !== null) {
            $validatorList = explode(',', $this->validators);
            if (!empty($validatorList)) {
                foreach ($validatorList as $validatorClass) {
                    if (class_exists($validatorClass) && is_subclass_of($validatorClass, 'Zend\Validator\ValidatorInterface')) {
                        /** @var \Zend\Validator\ValidatorInterface $validator */
                        $validator = new $validatorClass();
                        if (!$validator->isValid($value))
                            return false;
                    } else {
                        Logger::getLogger('registry')->notice("Wrong validator was set for type '" . $this->getTitle() . "': '$validatorClass'");
                    }
                }
            }
        }

        switch ($this->meta) {
            case static::META_SIMPLE:
                return true;
            case static::META_LIST:
                if ($this->availableValues && $this->availableValues->count() > 0) {
                    /** @var TypeValue $possibleValue */
                    foreach ($this->availableValues as $possibleValue) {
                        if ($value === $possibleValue->getValue())
                            return true;
                    }
                }
                return false;
            case static::META_SET:
                return true;
        }
        return false;
    }
}