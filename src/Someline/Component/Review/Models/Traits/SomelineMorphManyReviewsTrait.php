<?php

namespace Someline\Component\Review\Models\Traits;

use Someline\Models\Review\SomelineReview;

trait SomelineMorphManyReviewsTrait
{

    public function someline_reviews()
    {
        return $this->morphMany(SomelineReview::class, 'reviewable');
    }

    public function getSomelineReviews()
    {
        return $this->someline_reviews;
    }

}