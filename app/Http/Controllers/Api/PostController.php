<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\PostService;
use App\Services\UserService;

class PostController extends Controller
{
    private $postService;
    private $userService;

    public function __construct(PostService $postService, UserService $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function recentPosts()
    {
        $recentPosts = $this->postService->getRecentPosts();
        if ($recentPosts) {
            return response([
                'data' => $recentPosts,
                'message' => 'OK'
            ], 200);
        } else {
            return response([
                'message' => 'Error'
            ], 400);
        }
    }

    public function filterPosts(Request $request)
    {
        $filterPosts = $this->postService->filterPosts($request);
        if ($filterPosts) {
            return response([
                'data' => $filterPosts,
                'message' => 'OK'
            ], 200);
        } else {
            return response([
                'message' => 'Error'
            ], 400);
        }
    }

    public function detailPost($id)
    {
        $post = $this->postService->getDetailPost($id);
        if ($post) {
            return response([
                'data' => $post,
                'message' => 'OK'
            ], 200);
        } else {
            return response([
                'message' => 'Error'
            ], 400);
        }
    }

    public function create(PostRequest $request)
    {
        Post::create($request->validated());
        return response([
            'message' => 'Create new post successfully'
        ], 200);
    }

    public function edit(PostRequest $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            if ($request->user_id != '') {
                $user = $this->userService->findOrFailById($request->user_id);
                if ($user->can('edit', $post)) {
                    $post->update($request->validated());
                    return response([
                        'message' => 'Edit post successfully'
                    ], 200);
                } else {
                    return response([
                        'message' => 'Do not have permission'
                    ], 404);
                }
            } else {
                return response([
                    'message' => 'Please sign in/up account to do this action'
                ], 404);
            }
        } else {
            return response([
                'message' => 'This post is not exist'
            ], 404);
        }
    }

    public function delete(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            if ($request->user_id != '') {
                $user = $this->userService->findOrFailById($request->user_id);
                if ($user->can('delete', $post)) {
                    $post->delete();
                    return response([
                        'message' => 'Delete post successfully'
                    ], 200);
                } else {
                    return response([
                        'message' => 'Do not have permission'
                    ], 404);
                }
            } else {
                return response([
                    'message' => 'Please sign in/up account to do this action'
                ], 404);
            }
        } else {
            return response([
                'message' => 'This post is not exist'
            ], 400);
        }
    }

}
