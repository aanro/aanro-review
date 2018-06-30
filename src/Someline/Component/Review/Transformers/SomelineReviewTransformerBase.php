<?php

namespace Someline\Component\Review\Transformers;

use Someline\Models\Review\SomelineReview;
use Someline\Transformers\BaseTransformer;

/**
 * Class SomelineReviewTransformer
 * @package namespace Someline\Component\Review\Transformers;
 */
class SomelineReviewTransformerBase extends BaseTransformer
{

    /**
     * Transform the SomelineReview entity
     * @param SomelineReview $model
     *
     * @return array
     */
    public function transform(SomelineReview $model)
    {
        return [
            'someline_review_id' => (int)$model->someline_review_id,
            'user_id' => $model->getUserId(),

            /* place your other model properties here */
            'is_approved' => (boolean)$model->is_approved,
            'review_result' => $model->review_result,
            'review_text' => $model->review_text,
            'remarks' => $model->remarks,

            'created_at' => (string)$model->created_at,
            'updated_at' => (string)$model->updated_at
        ];
    }
}
