<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.08.14
 * Time: 14:40
 */

namespace Registry\Adapter\Doctrine\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * Class Registry
 * @package Registry\Entity
 * @Entity(readOnly=true)
 * @Table(name="registry")
 */
class Registry {
    /**
     * @var int
     * @Column(type="integer")
     * @Id()
     */
    protected $id;
    /**
     * @var string
     * @Column(type="string")
     */
    protected $path;
    /**
     * @var string
     * @Column(type="string")
     */
    protected $value;
    /**
     * @var Item|null
     * @OneToOne(targetEntity="Item")
     * @JoinColumn(name="id", referencedColumnName="id")
     */
    protected $item;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return Item|null
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }


}