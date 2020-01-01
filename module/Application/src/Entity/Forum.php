<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 16:21
 */

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Forum
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="forum")
 */
class Forum
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="date_create")
     */
    protected $date_create;

    /**
     * @ORM\OneToMany(targetEntity="Topics", mappedBy="forum")
     */
    protected $topics;

    /**
     * Forum constructor.
     */
    public function __construct()
    {
        $this->topics = new ArrayCollection();
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
     * @return Forum
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Forum
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }

    /**
     * @param mixed $date_create
     * @return Forum
     */
    public function setDateCreate($date_create)
    {
        $this->date_create = $date_create;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @param Topics $topic
     */
    public function addTopic(Topics $topic)
    {
        $this->topics[] = $topic;
    }

    /**
     * @return Forum
     */
    public function razTopics()
    {
        $this->topics = new ArrayCollection();
        return $this;
    }

}