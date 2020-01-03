<?php

namespace App\Entities\Blog;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="blog_items")
 * @ORM\Entity(repositoryClass="App\Repositories\Blog\Item")
 */
class Item implements ItemInterface
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
     * @ORM\Column(name="alias", type="string", length=300, nullable=true)
     */
    private $alias;

    /**
     * @var integer
     *
     * @ORM\Column(name="lock_alias", type="integer", nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="state", type="integer", nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=300, nullable=true)
     */
    private $name;

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
     * @ORM\ManyToOne(targetEntity="App\Entities\Blog\Category", inversedBy="items")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
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
     */
    public function setAnons($anons)
    {
        $this->anons = $anons;
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
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime $createdDate
     */
    public function setCreatedDate(\DateTime $createdDate)
    {
        $this->createdDate = $createdDate;
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
    public function getLockAlias()
    {
        return $this->lockAlias;
    }

    /**
     * @param int $lockAlias
     */
    public function setLockAlias($lockAlias)
    {
        $this->lockAlias = $lockAlias;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     */
    public function setPublicFrom(\DateTime $publicFrom)
    {
        $this->publicFrom = $publicFrom;
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
     */
    public function setPublicTo(\DateTime $publicTo)
    {
        $this->publicTo = $publicTo;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
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
     */
    public function setText($text)
    {
        $this->text = $text;
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
     */
    public function setCategory(CategoryInterface $category)
    {
        $prevCategory = $this->getCategory();
        if (!is_null($prevCategory) && $prevCategory->isEqual($category)) {
            return;
        }
        $this->category = $category;

        if (!is_null($prevCategory)) {
            $prevCategory->removeItem($this);
        }
        $category->addItem($this);
    }
}
