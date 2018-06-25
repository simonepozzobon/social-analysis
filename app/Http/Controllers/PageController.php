<?php

namespace App\Http\Controllers;

use App\Page;
use App\Post;
use Carbon\Carbon;
use App\Competitor;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function save_page_id(Request $r) {
        $page = Page::find($r->id);
        $page->FBid = $r->page_id;
        $page->save();

        $competitor = $page->competitor()->with('pages', 'pages.posts')->first();

        return $competitor;
    }

    public function save_posts(Request $r) {
        $posts = json_decode($r->posts);

        if (!$posts) {
            $posts = Post::where('page_id', $r->page_id)->get();
            return $posts;
        }

        foreach ($posts as $key => $post) {
            $p = Post::where('FBid', $post->id)->first();
            if (!$p) {
                $p = new Post();
                $p->page_id = $r->page_id;
                $p->created_time = $post->created_time;

                if (isset($post->message)) {
                    $p->message = $post->message;
                }

                if (isset($post->story)) {
                    $p->message = $post->story;
                }

                $p->FBid = $post->id;
                $p->save();
            }
        }

        $posts = Post::where('page_id', $r->page_id)->get();
        return $posts;
    }

}
