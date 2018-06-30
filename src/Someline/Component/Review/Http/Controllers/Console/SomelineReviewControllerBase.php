<?php

namespace Someline\Component\Review\Http\Controllers\Console;

use Someline\Http\Controllers\BaseController;

class SomelineReviewControllerBase extends BaseController
{

    public function getReviewList()
    {
        return view('console.reviews.list');
    }

    public function getReviewNew()
    {
        return view('console.reviews.new');
    }

    public function getReviewDetail($review_id)
    {
        return view('console.reviews.detail', compact('review_id'));
    }

    public function getReviewEdit($review_id)
    {
        return view('console.reviews.edit', compact('review_id'));
    }

}