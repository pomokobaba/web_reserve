<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller; 
use App\Http\Requests\Tweet\CreateRequest;
use App\Models\Tweet;
use App\Services\TweetService;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // FromRequestクラスをコントローラーで利用するため、引数に指定
    public function __invoke(CreateRequest $request, TweetService $tweetService)
    {
        // つぶやきと画像の保存
        $tweetService->saveTweet(
            $request->userID(),
            $request->tweet(),
            $request->images()
        );

        // 元の画面に戻す。
        return redirect()->route('tweet.index');
    }
}
