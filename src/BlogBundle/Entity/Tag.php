<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="tags", cascade={"persist"})
     * @ORM\JoinColumn(name="postId", referencedColumnName="id")
     */
     private $post;


    /**
     * Get the value of Post
     *
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set the value of Post
     *
     * @param mixed post
     *
     * @return self
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

}
