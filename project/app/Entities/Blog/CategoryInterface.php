<?php

namespace App\Entities\Blog;

use App\Entities\Blog\Exception\CannotAddItem;

interface CategoryInterface
{
    /**
     * @param PostInterface $post
     */
    public function removePost(PostInterface $post);

    /**
     * @param PostInterface $post
     *
     * @throws CannotAddItem
     */
    public function addPost(PostInterface $post);
}
