<?php

namespace Someline\Component\Review\Repositories\Eloquent;

use Someline\Repositories\Eloquent\BaseRepository;
use Someline\Repositories\Criteria\RequestCriteria;
use Someline\Repositories\Interfaces\SomelineReviewRepository;
use Someline\Models\Review\SomelineReview;
use Someline\Validators\SomelineReviewValidator;
use Someline\Component\Review\Presenters\SomelineReviewPresenter;

/**
 * Class SomelineReviewRepositoryEloquentBase
 * @package namespace Someline\Component\Review\Repositories\Eloquent;
 */
class SomelineReviewRepositoryEloquentBase extends BaseRepository implements SomelineReviewRepository
{

    protected $fieldSearchable = [
        'title' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SomelineReview::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return SomelineReviewValidator::class;
    }


    /**
     * Specify Presenter class name
     *
     * @return mixed
     */
    public function presenter()
    {

        return SomelineReviewPresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
