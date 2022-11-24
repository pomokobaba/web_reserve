<?php

namespace App\Services;

use App\Models\Tweet;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TweetService
{
    /**
     * tweetsテーブルから全てのデータの取得
     *
     * @return void　
     */
    public function getTweets() {
        return Tweet::with('images')->orderBy('created_at', 'DESC')->get();
        // return Tweet::orderBy('created_at', 'DESC')->get();
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

    /**
     * 昨日のつぶやきの数をカウント
     *
     * @return integer
     */
    public function countYesterdayTweets(): int
    {
        return Tweet::whereDate('created_at', '>=', Carbon::yesterday()->toDateTimeString())
            ->whereDate('created_at', '<', Carbon::today()->toDateTimeString())
            ->count();
    }

    /**
     * つぶやきと画像の保存
     *
     * @param integer $userId
     * @param string $content
     * @param array $images
     * @return void
     */
    public function saveTweet(int $userId, string $content, array $images)
    {
        DB::transaction(function () use($userId, $content, $images) {
            $tweet = new Tweet;
            $tweet->user_id = $userId;
            $tweet->content = $content;
            $tweet->save();
            foreach($images as $image) {
                Storage::putFile('public/images', $image);
                $imageModel = new Image();
                $imageModel->name = $image->hashName();
                $imageModel->save();
                $tweet->images()->attach($imageModel->id);
            }  
        });
    }

    /**
     * つぶやきと画像の削除
     *
     * @param integer $tweetId
     * @return void
     */
    public function deleteTweet(int $tweetId)
    {
        DB::transaction(function () use($tweetId) {
            $tweet = Tweet::where('id', $tweetId)->firstOrFail();
            $tweet->images()->each(function($image) use($tweet) {
                $filePath = 'public/images/' . $image->name;
                if(Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
                $tweet->images()->detach($image->id);
                $image->delete();
            });
            $tweet->delete();
        });
    }
}