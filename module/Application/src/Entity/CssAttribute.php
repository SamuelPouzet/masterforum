<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/12/2019
 * Time: 12:49
 */

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CssAttribute
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="css_attribute")
 */
class CssAttribute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="class_id")
     */
    protected $class_id;


    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="attribute")
     */
    protected $attribute;

    /**
     * @ORM\Column(name="addendum")
     */
    protected $addendum;

    /**
     * @ORM\ManyToOne(targetEntity="CssClass", inversedBy="attributes")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     */
    protected $class;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return CssAttribute
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClassId()
    {
        return $this->class_id;
    }

    /**
     * @param mixed $class_id
     * @return CssAttribute
     */
    public function setClassId($class_id)
    {
        $this->class_id = $class_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return CssAttribute
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return CssAttribute
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param mixed $attribute
     * @return CssAttribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddendum()
    {
        return $this->addendum;
    }

    /**
     * @param mixed $addendum
     * @return CssAttribute
     */
    public function setAddendum($addendum)
    {
        $this->addendum = $addendum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     * @return CssAttribute
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

}