<?php

namespace App\Entities\Blog;

use App\Entities\Blog\Exception\CannotAddItem;

interface CategoryInterface
{
    /**
     * @param ItemInterface $item
     */
    public function removeItem(ItemInterface $item);

    /**
     * @param ItemInterface $item
     *
     * @throws CannotAddItem
     */
    public function addItem(ItemInterface $item);
}
