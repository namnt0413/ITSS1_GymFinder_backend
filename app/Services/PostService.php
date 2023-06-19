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

    public function filterPosts($request)
    {
        $queryRaw = "";
        if(sizeof($request->options) !== 0) {
            foreach($request->options as $option)
            {
                $queryRaw == '' ? $queryRaw = $queryRaw . 'user_options.user_id IN ( SELECT user_options.user_id from user_options WHERE user_options.option_id = '.$option.' ) '
                            : $queryRaw = $queryRaw . 'and user_options.user_id IN ( SELECT user_options.user_id from user_options WHERE user_options.option_id = '.$option.' ) ';
            }
            $filterPosts = Post::selectRaw('DISTINCT posts.id,posts.title,posts.content,posts.image,posts.user_id,posts.created_at',)
            ->join('users','posts.user_id','=','users.id')
            ->join('user_options','users.id','=','user_options.user_id')
            ->where([ 'posts.status' => 2 ])
            ->where('posts.title', 'LIKE', '%' . $request->title . '%')
            ->whereRaw($queryRaw)
            ->with('user:id,name,logo')->get();
        }  else {
            $filterPosts = Post::selectRaw('DISTINCT posts.id,posts.title,posts.content,posts.image,posts.user_id,posts.created_at',)
            ->join('users','posts.user_id','=','users.id')
            ->join('user_options','users.id','=','user_options.user_id')
            ->where([ 'status' => 2 ])
            ->where('posts.title', 'LIKE', '%' . $request->title . '%')
            ->with('user:id,name,logo')->get();
        }
        return $filterPosts;
    }

    public function getDetailPost($id)
    {
        $post = Post::where(["id" => $id])
        ->with('user:id,name,logo')->get();
        return $post;
    }

}
