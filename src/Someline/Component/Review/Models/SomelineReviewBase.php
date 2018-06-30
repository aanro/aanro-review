<?php

namespace Someline\Component\Review\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Someline\Models\BaseModel;
use Someline\Models\Foundation\User;
use Someline\Models\Traits\RelationUserTrait;

class SomelineReviewBase extends BaseModel implements Transformable
{
    use TransformableTrait;
    use RelationUserTrait;
    use SoftDeletes;

    const MORPH_NAME = 'SomelineReview';

    protected $table = 'someline_reviews';

    protected $primaryKey = 'someline_review_id';

    protected $fillable = [
        'type',
        'reviewable_type',
        'reviewable_id',
        'user_id',
        'is_approved',
        'review_result',
        'review_text',
        'remarks',
        'data',
    ];

    // Fields to be converted to Carbon object automatically
    protected $dates = [
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }

    public function onCreated()
    {
        $this->fresh();
        $this->onReviewed($this->reviewable);
    }

    /**
     * $reviewable must implements SomelineReviewInterface
     *
     * @param SomelineReviewInterface $reviewable
     */
    protected function onReviewed(SomelineReviewInterface $reviewable)
    {
        $reviewable->onReviewed($this);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return boolean
     */
    public function isType($type)
    {
        return $this->type == $type;
    }

    /**
     * @return mixed
     */
    public function getSomelineReviewId()
    {
        return $this->someline_review_id;
    }

    /**
     * @return mixed
     */
    public function isApproved()
    {
        return $this->is_approved;
    }

    /**
     * @return mixed
     */
    public function getReviewResult()
    {
        return $this->review_result;
    }

    /**
     * @return mixed
     */
    public function getReviewText()
    {
        return $this->review_text;
    }

    /**
     * @return mixed
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getData()
    {
        return collect(json_decode($this->data, true));
    }

    /**
     * @param $data
     */
    public function updateData($data)
    {
        if (empty($data)) {
            return;
        }
        $this->data = json_encode($data);
        $this->save();
    }


}
