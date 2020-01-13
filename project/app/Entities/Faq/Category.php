<?php

namespace App\Entities\Faq;

use App\Entities\Faq\Exception\CannotAddQuestion;
use App\Entities\Faq\Exception\CannotRemoveQuestion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="faq_categories")
 * @ORM\Entity(repositoryClass="App\Repositories\Faq\Category")
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
     * @ORM\OneToMany(targetEntity="Question", mappedBy="category")
     */
    private $questions;

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
        $this->questions = new ArrayCollection();
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
     * @param QuestionInterface $question
     * @return bool
     */
    public function hasQuestion(QuestionInterface $question)
    {
        return $this->questions->contains($question);
    }

    /**
     * @return int
     */
    public function countQuestions()
    {
        return $this->questions->count();
    }

    /**
     * @return bool
     */
    public function hasQuestions()
    {
        return !$this->questions->isEmpty();
    }

    /**
     * @return bool
     */
    public function hasActiveQuestions()
    {
        return $this->hasQuestions();
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
     * @return Question[]
     */
    public function getQuestions()
    {
        $criteria = Criteria::create()
            ->orderBy(array("position" => Criteria::ASC, "createDate" => Criteria::DESC));
        return $this->questions->matching($criteria)->toArray();
    }

    /**
     * @param QuestionInterface $question
     * @throws CannotAddQuestion
     */
    public function addQuestion(QuestionInterface $question)
    {
        if ($question->getCategory() != $this) {
            $question->setCategory($this);
            return;
        }

        if (!$this->hasQuestion($question)) {
            $this->questions->add($question);
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
     * @param QuestionInterface $question
     * @throws Exception\CannotRemoveQuestion
     */
    public function removeQuestion(QuestionInterface $question)
    {
        if ($question->getCategory() == $this) {
            throw new CannotRemoveQuestion('You cannot directly delete a question');
        }

        if ($this->hasQuestion($question)) {
            $this->questions->removeElement($question);
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
     * @internal param int|null $nrColumns - количество колонок
     * @return \Doctrine\Common\Collections\Collection|static
     */
    public function getFavoriteQuestions()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("favorite", true))
            ->orderBy(array("position" => Criteria::ASC, "createDate" => Criteria::DESC));
        return $this->questions->matching($criteria);
    }

    public function hasFavoriteQuestions()
    {
        $favorite = $this->getFavoriteQuestions();
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
