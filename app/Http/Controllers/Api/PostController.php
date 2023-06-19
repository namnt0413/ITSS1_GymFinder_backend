<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

}
