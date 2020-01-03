<?php

namespace App\Entities\Faq;

use App\Entities\Faq\Exception\CannotAddQuestion;

interface CategoryInterface
{
    /**
     * @param QuestionInterface $question
     */
    public function removeQuestion(QuestionInterface $question);

    /**
     * @param QuestionInterface $question
     *
     * @throws CannotAddQuestion
     */
    public function addQuestion(QuestionInterface $question);
}
