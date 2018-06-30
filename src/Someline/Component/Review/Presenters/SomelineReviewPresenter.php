<?php

namespace Someline\Component\Review\Presenters;

use Someline\Transformers\SomelineReviewTransformer;
use Someline\Presenters\BasePresenter;

/**
 * Class SomelineReviewPresenter
 *
 * @package namespace Someline\Component\Review\Presenters;
 */
class SomelineReviewPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SomelineReviewTransformer();
    }
}
