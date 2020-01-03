<?php

namespace App\Entities\Blog;

use App\Entities\Blog\Exception\CannotAddItem;
use App\Entities\Blog\Exception\CannotRemoveItem;
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
     * @var integer
     *
     * @ORM\Column(name="ord", type="integer", nullable=true)
     */
    private $ord;

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
     * @var Collection|Selectable
     *
     * @ORM\OneToMany(targetEntity="Item", mappedBy="category")
     */
    private $items;

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
     * @return Item[]
     */
    public function getItems()
    {
        $criteria = Criteria::create()
            ->orderBy(array("position" => Criteria::ASC, "createDate" => Criteria::DESC));
        return $this->items->matching($criteria)->toArray();
    }

    /**
     * @param ItemInterface $item
     * @throws CannotAddItem
     */
    public function addItem(ItemInterface $item)
    {
        if ($item->getCategory() != $this) {
            $item->setCategory($this);
            return;
        }

        if (!$this->hasItem($item)) {
            $this->items->add($item);
        }
    }

    /**
     * @param ItemInterface $item
     *
     * @return bool
     */
    public function hasItem(ItemInterface $item)
    {
        return $this->items->contains($item);
    }

    /**
     * @return int
     */
    public function countItems()
    {
        return $this->items->count();
    }

    /**
     * @return bool
     */
    public function hasItems()
    {
        return !$this->items->isEmpty();
    }

    /**
     * @return bool
     */
    public function hasActiveItems()
    {
        return $this->hasItems();
    }

    /**
     * @return int
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param ItemInterface $item
     * @throws Exception\CannotRemoveItem
     */
    public function removeItem(ItemInterface $item)
    {
        if ($item->getCategory() == $this) {
            throw new CannotRemoveItem('Cannot delete item directly');
        }

        if ($this->hasItem($item)) {
            $this->items->removeElement($item);
        }
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
     * @return int
     */
    public function getOrd()
    {
        return $this->ord;
    }

    /**
     * @param int $ord
     */
    public function setOrd($ord)
    {
        $this->ord = $ord;
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
}
