<?php

namespace App\Entities\Blog;

interface PostInterface
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
