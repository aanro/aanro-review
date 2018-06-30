<?php

namespace Someline\Component\Review\Models;


use Someline\Models\Review\SomelineReview;

interface SomelineReviewInterface
{

    public function onReviewed(SomelineReview $somelineReview);

}