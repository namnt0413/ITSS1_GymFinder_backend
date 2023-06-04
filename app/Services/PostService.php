<?php
namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;

class PostService
{
    public function getRecentPosts()
    {
        $recentPosts = Post::select('*')->where([ 'status' => 2 ])
        ->orderBy('created_at','desc')->limit(5)->with('user:id,name,logo')->get();
        return $recentPosts;
    }
}
