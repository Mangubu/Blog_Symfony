<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use BlogBundle\Entity\Post;

/**
* Category
*
* @ORM\Table(name="category")
* @ORM\Entity(repositoryClass="BlogBundle\Repository\CategoryRepository")
*/
class Category
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
  * @ORM\Column(name="name", type="string", length=255, unique=true)
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
  * @return Category
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
  * @var ArrayCollection $posts
  *
  * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
  */
  private $posts;

  /**
  * @param BDepartement $departements
  */
  public function addPosts(Post $post) {
    $post->setCategory($this);

    if (!$this->post->contains($post)) {
      $this->post->add($post);
    }
  }

  /**
  * @return ArrayCollection $posts
  */
  public function getPosts() {
    return $this->posts;
  }


  public function __construct() {
    $this->posts = new ArrayCollection();
  }
}
