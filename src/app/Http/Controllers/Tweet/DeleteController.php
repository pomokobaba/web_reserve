<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DeleteController extends Controller
{
    /**
     * 削除
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        $tweetId = (int) $request->route('tweetId');
        // 自分のツイートかチェック
        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId))
        {
            // 他人の投稿したツイートにアクセスすると403エラー
            throw new AccessDeniedHttpException();
        }
        // tweetIdを元にtweetsテーブルから、削除したい列を取得
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        // 列の削除
        $tweet->delete();

        return redirect()
            ->route('tweet.index')
            ->with('feedback.success', "つぶやきを削除しました");
    }
}
