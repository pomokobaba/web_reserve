<?php

namespace App\Services;

use App\Models\Tweet;

class TweetService
{
    public function getTweets() {
        // DBから値を取得するときに、作成の降順で取得する
        return Tweet::orderBy('created_at', 'DESC')->get();
    }

}