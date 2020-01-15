<?php

namespace App\Entities\Blog;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="blog_items")
 * @ORM\Entity(repositoryClass="App\Repositories\Blog\Post")
 */
class Post implements PostInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identity;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=300, nullable=false)
     */
    private $alias;

    /**
     * @var integer
     *
     * @ORM\Column(name="lockalias", type="boolean", nullable=false)
     */
    private $lockAlias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="public_from", type="date", nullable=true)
     */
    private $publicFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="public_to", type="date", nullable=true)
     */
    private $publicTo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var State
     *
     * @ORM\Embedded(class="App\Entities\Blog\State", columnPrefix = false)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="anons", type="string", length=1000, nullable=true)
     */
    private $anons;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=3000, nullable=true)
     */
    private $text;

    /**
     * @var \App\Entities\Blog\Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entities\Blog\Category", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;

    public function __construct()
    {
        $this->createdDate = new \DateTime();
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     *
     * @return Post
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnons()
    {
        return $this->anons;
    }

    /**
     * @param string $anons
     *
     * @return Post
     */
    public function setAnons($anons)
    {
        $this->anons = $anons;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     *
     * @return Post
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime $createdDate
     *
     * @return Post
     */
    public function setCreatedDate(\DateTime $createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @return int
     */
    public function isLockAlias()
    {
        return $this->lockAlias;
    }

    /**
     * @param int $lockAlias
     *
     * @return Post
     */
    public function setLockAlias($lockAlias)
    {
        $this->lockAlias = $lockAlias;

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
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublicFrom()
    {
        return $this->publicFrom;
    }

    /**
     * @param \DateTime $publicFrom
     *
     * @return Post
     */
    public function setPublicFrom(\DateTime $publicFrom)
    {
        $this->publicFrom = $publicFrom;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublicTo()
    {
        return $this->publicTo;
    }

    /**
     * @param \DateTime $publicTo
     *
     * @return Post
     */
    public function setPublicTo(\DateTime $publicTo)
    {
        $this->publicTo = $publicTo;

        return $this;
    }

    /**
     * @return State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param State $state
     *
     * @return Post
     */
    public function setState(State $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->getState()->isActive();
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param CategoryInterface $category
     *
     * @return Post
     */
    public function setCategory(CategoryInterface $category)
    {
        $prevCategory = $this->getCategory();
        if (!is_null($prevCategory) && $prevCategory->isEqual($category)) {
            return $this;
        }
        $this->category = $category;

        if (!is_null($prevCategory)) {
            $prevCategory->removePost($this);
        }
        $category->addPost($this);

        return $this;
    }
}
