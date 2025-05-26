<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\StorePostRequest;
use App\Http\Requests\Api\Post\UpdatePostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends AppBaseController
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        return $this->postService->list($request);
    }

    public function store(StorePostRequest $request)
    {
        return $this->postService->create($request->validated(), $request->user());
    }

    public function update(UpdatePostRequest $request, $id)
    {
        return $this->postService->update($id, $request->validated(), $request->user());
    }

    public function destroy($id)
    {
        return $this->postService->delete($id, auth()->user());
    }
}
