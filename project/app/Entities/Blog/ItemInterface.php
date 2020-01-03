<?php

namespace App\Entities\Blog;

interface ItemInterface
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
