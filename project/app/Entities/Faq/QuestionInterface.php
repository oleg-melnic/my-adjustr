<?php

namespace App\Entities\Faq;

interface QuestionInterface
{
    /**
     * @param CategoryInterface $category
     */
    public function setCategory(CategoryInterface $category);

    /**
     * @return CategoryInterface $category
     */
    public function getCategory();
}
