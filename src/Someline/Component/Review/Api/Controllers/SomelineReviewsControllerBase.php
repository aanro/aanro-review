<?php

namespace Someline\Component\Review\Api\Controllers;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Someline\Api\Controllers\BaseController;
use Someline\Models\Review\SomelineReview;
use Someline\Repositories\Interfaces\SomelineReviewRepository;
use Someline\Validators\SomelineReviewValidator;

class SomelineReviewsControllerBase extends BaseController
{

    /**
     * @var SomelineReviewRepository
     */
    protected $repository;

    /**
     * @var SomelineReviewValidator
     */
    protected $validator;

    public function __construct(SomelineReviewRepository $repository, SomelineReviewValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

        if (!empty($data['data'])) {
            $data['data'] = json_encode($data['data']);
        }

        /** @var SomelineReview $somelineReview */
        $somelineReview = $this->repository->create($data);

        // throw exception if store failed
//        throw new StoreResourceFailedException('Failed to store.');

        // A. return 201 created
        return $this->response->created(null);

        // B. return data
//        return $somelineReview;

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        if (!empty($data['data'])) {
            $data['data'] = json_encode($data['data']);
        }

        $somelineReview = $this->repository->update($data, $id);

        // throw exception if update failed
//        throw new UpdateResourceFailedException('Failed to update.');

        // Updated, return 204 No Content
        return $this->response->noContent();

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if ($deleted) {
            // Deleted, return 204 No Content
            return $this->response->noContent();
        } else {
            // Failed, throw exception
            throw new DeleteResourceFailedException('Failed to delete.');
        }
    }
}
