<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 16:28
 */

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Subjects
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Posts
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="content")
     */
    protected $content;

    /**
     * @ORM\GeneratedValue
     * @ORM\Column(name="date_create")
     */
    protected $date_create;

    /**
     * @ORM\Column(name="subject_id")
     */
    protected $subject_id;

    /**
     * @ORM\ManyToOne(targetEntity="Subjects", inversedBy="posts")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     */
    protected $subject;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Posts
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Posts
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        if($this->date_create) {
            return new \DateTime($this->date_create);
        }
        return null;
    }

    /**
     * @param mixed $date_create
     * @return Posts
     */
    public function setDateCreate($date_create)
    {
        $this->date_create = $date_create;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubjectId()
    {
        return $this->subject_id;
    }

    /**
     * @param mixed $subject_id
     * @return Posts
     */
    public function setSubjectId($subject_id)
    {
        $this->subject_id = $subject_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return Posts
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

}