<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* Post
*
* @ORM\Table(name="post")
* @ORM\Table(indexes={@ORM\Index(name="title_idx", columns={"title"})})
* @ORM\Entity(repositoryClass="BlogBundle\Repository\PostRepository")
*/
class Post
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
  * @ORM\Column(name="title", type="string", length=255, unique=true)
  */
  private $title;

  /**
  * @var string
  *
  * @ORM\Column(name="content", type="text")
  */
  private $content;

  /**
  * @var \DateTime
  *
  * @ORM\Column(name="publicationDate", type="datetime")
  */
  private $publicationDate;

  /**
  * @var string
  *
  * @ORM\Column(name="author", type="string", length=255, nullable=true)
  */
  private $author;

  /**
  * @var integer
  *
  * @ORM\ManyToOne(targetEntity="Category")
  * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
  */
  private $category;
  /**
  * Set category
  *
  * @param Category $category
  * @return Post
  */
  public function setCategory($category)
  {
    $this->category = $category;

    return $this;
  }

  /**
  * Get category
  *
  * @return Category
  */
  public function getCategory()
  {
    return $this->category;
  }

  //private $tags;

  // /**
  // * @var string
  // *
  // * @ORM\Column(name="comments", type="string", length=255, nullable=true)
  // */
  // private $comments;


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
  * Set title
  *
  * @param string $title
  * @return Post
  */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
  * Get title
  *
  * @return string
  */
  public function getTitle()
  {
    return $this->title;
  }

  /**
  * Set content
  *
  * @param string $content
  * @return Post
  */
  public function setContent($content)
  {
    $this->content = $content;

    return $this;
  }

  /**
  * Get content
  *
  * @return string
  */
  public function getContent()
  {
    return $this->content;
  }

  /**
  * Set publicationDate
  *
  * @param \DateTime $publicationDate
  * @return Post
  */
  public function setPublicationDate($publicationDate)
  {
    $this->publicationDate = $publicationDate;

    return $this;
  }

  /**
  * Get publicationDate
  *
  * @return \DateTime
  */
  public function getPublicationDate()
  {
    return $this->publicationDate;
  }

  /**
  * Set author
  *
  * @param string $author
  * @return Post
  */
  public function setAuthor($author)
  {
    $this->author = $author;

    return $this;
  }

  /**
  * Get author
  *
  * @return string
  */
  public function getAuthor()
  {
    return $this->author;
  }


  /**
  * @var ArrayCollection $tags
  *
  * @ORM\OneToMany(targetEntity="Tag", mappedBy="post", cascade={"all"})
  */
  private $tags;

  /**
  * @param Tag $tag
  */
  public function addTag(Tag $tag) {
    $tag->setPost($this);

    if (!$this->tags->contains($tag)) {
      $this->tags->add($tag);
    }
  }

  public function removeTag(Tag $tag) {
    $this->tags->remove($tag);
  }

  /**
  * @return ArrayCollection $tags
  */
  public function getTags() {
    return $this->tags;
  }

  /**
  * @var ArrayCollection $comment
  *
  * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
  */
  private $comments;

  /**
  * @param BDepartement $departements
  */
  public function addComments(Comment $comment) {
    $comment->setPost($this);

    if (!$this->comment->contains($comment)) {
      $this->comment->add($comment);
    }
  }

  /**
  * @return ArrayCollection $comments
  */
  public function getComments() {
    return $this->comments;
  }

  public function __construct() {
    $this->publicationDate = new \DateTime();
    $this->comments = new ArrayCollection();
    $this->tags = new ArrayCollection();
  }
}
