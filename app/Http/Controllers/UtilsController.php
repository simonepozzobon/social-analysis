<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Facebook;

class UtilsController extends Controller
{
    public function connect() {
        $fb = new Facebook([
            'app_id' => env('FB_APP_ID'),
            'app_secret' => env('FB_APP_SECRET'),
            'default_graph_version' => 'v3.0',
        ]);
        return $fb;
    }

    public function get_fb_token(Request $r)
    {
        $fb = $this->connect();
        $helper = $fb->getJavaScriptHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            return 'No cookie set or no OAuth data could be obtained from cookie.';
            exit;
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;
        return $accessToken->getValue();
    }


    public function get_facebook_id(Request $r)
    {
        $fb = $this->connect();
        $pageUrl = urlencode($r->pageUrl);
        try {
            // Returns a `FacebookFacebookResponse` object
            $response = $fb->get(
                $pageUrl,
                $r->fb_token
            );
        } catch(FacebookExceptionsFacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $graphNode = $response->getGraphNode();
        return $graphNode;
    }
}
