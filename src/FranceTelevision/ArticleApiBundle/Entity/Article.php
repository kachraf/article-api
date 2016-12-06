<?php

namespace FranceTelevision\ArticleApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * Article.
 *
 * @ORM\Table(name="article")
 * @ORM\Entity()
 *
 * @Hateoas\Relation("self", href = "expr('/articles/' ~ object.getSlug())")
 * @ExclusionPolicy("all")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     * @Groups({ "getAll", "getOne"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Expose
     * @Groups({ "getAll", "getOne"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="leading_article", type="text", nullable=true)
     * @Expose
     * @Groups({ "getAll", "getOne"})
     */
    private $leading;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     * @Expose
     * @Groups({ "getOne"})
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Expose
     * @Groups({ "getAll", "getOne"})
     */
    private $createdAt;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Expose
     * @Groups({ "getAll", "getOne"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="createdBy", type="string", length=255)
     * @Expose
     * @Groups({ "getAll", "getOne"})
     */
    private $createdBy;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getLeading()
    {
        return $this->leading;
    }

    /**
     * @param string $leading
     * @return Article
     */
    public function setLeading($leading)
    {
        $this->leading = $leading;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Article
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        if($createdAt == null){
            $this->createdAt = new \DateTime('now');
        }else{
            $this->createdAt = $createdAt;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     * @return Article
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }
}
