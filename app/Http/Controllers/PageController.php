<?php

namespace App\Http\Controllers;

use App\Page;
use App\Post;
use Carbon\Carbon;
use App\Competitor;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function get_competitor($id) {
        $competitor = Competitor::where('id', $id)->with('pages', 'pages.posts')->first();

        $competitor = $this->stats_short($competitor);
        return $competitor;
    }

    public function save_page_id(Request $r) {
        $page = Page::find($r->id);
        $page->FBid = $r->page_id;
        $page->save();

        $competitor = $page->competitor()->with('pages', 'pages.posts')->first();
        $competitor = $this->stats_short($competitor);
        
        return $competitor;
    }

    public function save_posts(Request $r) {
        $posts = json_decode($r->posts);
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

    public function stats_short($competitor) {
        $page = $competitor->pages->first();
        $competitor->stats = $this->stats($page->id);
        return $competitor;
    }

    public function stats($id) {
        $page = Page::find($id);

        $posts = $page->posts()->get();
        $count = $posts->count();

        $d = collect();

        foreach ($posts as $key => $post) {
            if ( $key > 0 && $key <= ($count - 1) ) {
                $d1 = Carbon::parse($post->created_time);
                $d2 = Carbon::parse($posts[$key - 1]->created_time);
                $dt = $d1->diffInDays($d2);
                $d->push($dt);
            }
        }

        $sum = 0;
        foreach ($d as $key => $value) {
            $sum = $sum + $value;
        }
        $avg = $sum / $d->count();
        return $avg;
    }
}
