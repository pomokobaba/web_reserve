<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IndexController extends Controller
{
    /**
     * 表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        // パラメーターからtweetId取得
        $tweetId = (int) $request->route('tweetId');

        // 自分のツイートかチェック
        if(!$tweetService->checkOwnTweet($request->user()->id, $tweetId))
        {
            // 他人の投稿したツイートにアクセスすると403エラー
            throw new AccessDeniedHttpException();
        }

        // tweetIdからツイートを取得
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
       
        // ツイートをtweetに入れて返す
        return view('tweet.update')->with('tweet', $tweet);
    }
}
