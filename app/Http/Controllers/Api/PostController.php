<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    private $PostService;

    public function __construct( PostService $PostService){
        $this->PostService = $PostService;
    }

    public function recentPosts()
    {
        $recentPosts = $this->PostService->getRecentPosts();
        if ( $recentPosts ) {
            return response([
                'data' => $recentPosts,
                'message' => 'OK'
            ],200);
        } else {
            return response([
                'message' => 'Error'
            ],400);
        }
    }

    public function filterPosts(Request $request)
    {
        $filterPosts = $this->PostService->filterPosts($request);
        if ( $filterPosts ) {
            return response([
                'data' => $filterPosts,
                'message' => 'OK'
            ],200);
        } else {
            return response([
                'message' => 'Error'
            ],400);
        }
    }

    public function detailPost($id)
    {
        $post = $this->PostService->getDetailPost($id);
        if ( $post ) {
            return response([
                'data' => $post,
                'message' => 'OK'
            ],200);
        } else {
            return response([
                'message' => 'Error'
            ],400);
        }
    }

    public function create(PostRequest $request)
    {
        Post::create($request->validated());
        return response([
            'message' => 'Create new post successfully'
        ],200);
    }

    public function edit(PostRequest $request , $id)
    {
        $post = Post::find($id);
        if ( $post ) {
            $post->update($request->validated());
            return response([
                'message' => 'Edit post successfully'
            ],200);
        } else {
            return response([
                'message' => 'This post is not exist'
            ],400);
        }
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ( $post ) {
            $post->delete();
            return response([
                'message' => 'Delete post successfully'
            ],200);
        } else {
            return response([
                'message' => 'This post is not exist'
            ],400);
        }
    }

}
