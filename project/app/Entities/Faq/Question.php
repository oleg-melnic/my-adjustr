<?php

namespace App\Entities\Faq;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="faq_questions")
 * @ORM\Entity(repositoryClass="App\Repositories\Faq\Question")
 */
class Question implements QuestionInterface
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;

    /**
     * @var string $answer
     *
     * @ORM\Column(name="answer", type="text", nullable=false)
     */
    protected $answer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var \App\Entities\Faq\Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entities\Faq\Category", inversedBy="questions")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;

    /**
     * @var boolean
     *
     * @ORM\Column(name="favorite", type="boolean", nullable=false)
     */
    private $favorite;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, nullable=false)
     */
    private $alias;

    /**
     * @var bool
     *
     * @ORM\Column(name="lockalias", type="boolean", nullable=false)
     */
    private $lockalias;

    /**
     * @var bool
     */
    const DEFAULT_FAVORITE = false;

    public function __construct()
    {
        $this->favorite = self::DEFAULT_FAVORITE;
        $this->createDate = new \DateTime();
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
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     *
     * @return Question
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return Question
     */
    public function setPosition($position)
    {
        $this->position = $position;

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
     * @return Question|void
     */
    public function setCategory(CategoryInterface $category)
    {
        $prevCategory = $this->getCategory();
        if (!is_null($prevCategory) && $prevCategory->isEqual($category)) {
            return $this;
        }

        $this->category = $category;

        if (!is_null($prevCategory)) {
            $prevCategory->removeQuestion($this);
        }
        $category->addQuestion($this);

        return $this;
    }

    /**
     * @return bool
     */
    public function isFavorite()
    {
        return $this->favorite;
    }

    /**
     * @param bool $favorite
     *
     * @return Question
     */
    public function setIsFavorite($favorite)
    {
        $this->favorite = (bool)$favorite;

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
     * @param string $alias
     *
     * @return Question
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
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
     * @return Question
     */
    public function setLockAlias(bool $lock)
    {
        $this->lockalias = $lock;

        return $this;
    }
}
