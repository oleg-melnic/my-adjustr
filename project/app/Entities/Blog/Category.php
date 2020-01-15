<?php

namespace App\Entities\Blog;

use App\Entities\Blog\Exception\CannotAddItem;
use App\Entities\Blog\Exception\CannotRemoveItem;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="blog_categories")
 * @ORM\Entity(repositoryClass="App\Repositories\Blog\Category")
 * @ORM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Category implements CategoryInterface
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
     * @var Collection|Selectable
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
     */
    private $posts;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", nullable=false)
     */
    private $alias;

    /**
     * @var bool
     *
     * @ORM\Column(name="lockalias", type="boolean", nullable=false)
     */
    private $lockalias;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;

    /**
     * @var string $seoTitle
     *
     * @ORM\Column(name="seo_title", type="string", nullable=true)
     */
    protected $seoTitle;

    /**
     * @var string $seoDescription
     *
     * @ORM\Column(name="seo_description", type="string", nullable=true)
     */
    protected $seoDescription;

    /**
     * @var string $seoKeywords
     *
     * @ORM\Column(name="seo_keywords", type="string", nullable=true)
     */
    protected $seoKeywords;

    /**
     * @var string $text
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    protected $text;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true, options={"default":"0"})
     */
    private $position;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
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
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $seoDescription
     *
     * @return Category
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * @param string $seoKeywords
     *
     * @return Category
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * @param string $seoTitle
     *
     * @return Category
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
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
     * @return Category
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param PostInterface $post
     *
     * @return bool
     */
    public function hasPost(PostInterface $post)
    {
        return $this->posts->contains($post);
    }

    /**
     * @return int
     */
    public function countPosts()
    {
        return $this->posts->count();
    }

    /**
     * @return bool
     */
    public function hasPosts()
    {
        return !$this->posts->isEmpty();
    }

    /**
     * @return bool
     */
    public function hasActivePosts()
    {
        return $this->hasPosts();
    }

    /**
     * @param int $position
     *
     * @return Category
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return Post[]
     */
    public function getPosts()
    {
        $criteria = Criteria::create()
            ->orderBy(array("position" => Criteria::ASC, "createDate" => Criteria::DESC));
        return $this->posts->matching($criteria)->toArray();
    }

    /**
     * @param PostInterface $post
     * @throws CannotAddItem
     */
    public function addPost(PostInterface $post)
    {
        if ($post->getCategory() != $this) {
            $post->setCategory($this);
            return;
        }

        if (!$this->hasPost($post)) {
            $this->posts->add($post);
        }
    }

    /**
     * @return int
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param PostInterface $post
     * @throws Exception\CannotRemoveItem
     */
    public function removePost(PostInterface $post)
    {
        if ($post->getCategory() == $this) {
            throw new CannotRemoveItem('You cannot directly delete a post');
        }

        if ($this->hasPost($post)) {
            $this->posts->removeElement($post);
        }
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
     * @return Category
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @internal param int|null $nrColumns - cols count
     *
     * @return \Doctrine\Common\Collections\Collection|static
     */
    public function getFavoritePosts()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("favorite", true))
            ->orderBy(array("position" => Criteria::ASC, "createDate" => Criteria::DESC));
        return $this->posts->matching($criteria);
    }

    public function hasFavoritePosts()
    {
        $favorite = $this->getFavoritePosts();
        if (!$favorite->isEmpty()) {
            return true;
        }
        return false;
    }

    /**
     * @param CategoryInterface $category
     * @return boolean
     */
    public function isEqual($category)
    {
        if (is_null($this->getIdentity()) || is_null($category->getIdentity())) {
            return $category === $this;
        } else {
            return ($this->getIdentity() == $category->getIdentity());
        }
    }

    /**
     * @return bool
     */
    public function isLockAlias(): bool
    {
        return $this->lockalias;
    }

    /**
     * @param bool $lock
     *
     * @return Category
     */
    public function setLockAlias(bool $lock)
    {
        $this->lockalias = $lock;

        return $this;
    }
}
