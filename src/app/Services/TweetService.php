<?php

namespace App\Services;

use App\Models\Tweet;

class TweetService
{
    /**
     * tweetsテーブルから全てのデータの取得
     *
     * @return void　
     */
    public function getTweets() {
        return Tweet::orderBy('created_at', 'DESC')->get();
    }

    /**
     * 自分のツイートかどうかチェック
     *
     * @param integer $userId
     * @param integer $tweetId
     * @return boolean
     */
    public function checkOwnTweet(int $userId, int $tweetId): bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        if(!$tweet) {
            return false;
        }
        return $tweet->user_id === $userId;
    }
}