<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/12/2019
 * Time: 12:49
 */

namespace Application\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CssClass
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="css_class")
 */
class CssClass implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="forum_id")
     */
    protected $forum_id;

    /**
     * @ORM\Column(name="type")
     */
    protected $type;

    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="CssAttribute", mappedBy="class")
     */
    protected $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return cssClass
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForumId()
    {
        return $this->forum_id;
    }

    /**
     * @param mixed $forum_id
     * @return cssClass
     */
    public function setForumId($forum_id)
    {
        $this->forum_id = $forum_id;
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
     * @return cssClass
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
     * @return cssClass
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function addAttribute(CssAttribute $attribute)
    {
        $this->attributes[] = $attribute;
    }

    public function removeAttributes()
    {
        $this->attributes = new ArrayCollection();
    }
}