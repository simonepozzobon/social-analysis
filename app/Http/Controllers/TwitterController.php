<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Tweet;
use App\Mention;
use App\TwProfile;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function __construct() {
        $this->settings = [
            'oauth_access_token' => env('TW_TOKEN'),
            'oauth_access_token_secret' => env('TW_TOKEN_SECRET'),
            'consumer_key' => env('TW_API'),
            'consumer_secret' => env('TW_SECRET')
        ];
    }

    public function get_tweets($id = 1) {
        $profile = TwProfile::find($id);

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $requestMethod = 'GET';
        $getfield = '?screen_name='.$profile->screename;

        $twitter = new \TwitterAPIExchange($this->settings);
        $response = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
        $tweets = json_decode($response);

        foreach ($tweets as $key => $tweet) {
            $t = Tweet::where('TWid', $tweet->id)->first();
            if (!$t) {
                $t = new Tweet();
                $t->tw_profile_id = $id;
                $t->created_time = $tweet->created_at;
                $t->TWid = $tweet->id;
                $t->message = $tweet->text;
                $t->retweets = $tweet->retweet_count;
                $t->favorites = $tweet->favorite_count;
                $t->save();

                if (count($tweet->entities->hashtags) > 0) {
                    foreach ($tweet->entities->hashtags as $key => $tag) {
                        $h = Tag::where('tag', $tag->text)->first();
                        if (!$h) {
                            $h = new Tag();
                            $h->tag = $tag->text;
                            $h->save();
                            $t->tags()->save($h);
                        } else {
                            $t->tags()->save($h);
                        }
                    }
                }

                if (count($tweet->entities->user_mentions) > 0) {
                    foreach ($tweet->entities->user_mentions as $key => $mention) {
                        $m = Mention::where('screen_name', $mention->screen_name)->first();
                        if (!$m) {
                            $m = new Mention();
                            $m->screen_name = $mention->screen_name;
                            $m->save();
                            $t->mentions()->save($m);
                        } else {
                            $t->mentions()->save($m);
                        }
                    }
                }
            }
        }

        $tweets = Tweet::where('tw_profile_id', $id)->get();
        return $tweets;
    }
}
