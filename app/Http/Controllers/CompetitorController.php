<?php

namespace App\Http\Controllers;

use App\Page;
use App\TwProfile;
use Carbon\Carbon;
use App\Competitor;
use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    public function get_competitors(Request $r) {
        $competitors = Competitor::with('pages', 'pages.posts', 'twitter_profiles', 'twitter_profiles.tweets')->get();
        $competitors = $this->stats($competitors);
        return $competitors;
    }

    public function stats($competitors) {
        foreach ($competitors as $key => $competitor) {

            // Facebook Stats
            $pages = $competitor->pages;
            foreach ($pages as $page) {
                $page->stats = $this->facebook_stats($page->id);
            }

            // Twitter Stats
            $profiles = $competitor->twitter_profiles;
            foreach ($profiles as $profile) {
                $profile->stats = $this->twitter_stats($profile->id);
            }
        }

        return $competitors;
    }

    public function facebook_stats($id) {
        $page = Page::find($id);

        $posts = $page->posts()->get();
        $count = $posts->count();

        if ($count == 0) {
            return 0;
        }

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

    public function twitter_stats($id) {
        $profile = TwProfile::find($id);

        $tweets = $profile->tweets()->get();
        $count = $tweets->count();

        if ($count == 0) {
            return 0;
        }

        $d = collect();

        foreach ($tweets as $key => $tweet) {
            if ( $key > 0 && $key <= ($count - 1) ) {
                $d1 = Carbon::parse($tweet->created_time);
                $d2 = Carbon::parse($tweets[$key - 1]->created_time);
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
