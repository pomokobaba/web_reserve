<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\UpdateRequest;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PutController extends Controller
{
    /**
     * 変更
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request, TweetService $tweetService)
    {
        // 自分のツイートかチェック
        if(!$tweetService->checkOwnTweet($request->user()->id, $request->id()))
        {
            // 他人の投稿したツイートにアクセスすると403エラー
            throw new AccessDeniedHttpException();
        }

        // DBに既に保存してあるツイートを取得
        $tweet = Tweet::where('id', $request->id())->firstOrFail();
        // 画面で入力したツイートを取得
        $tweet->content = $request->tweet();
        // DBに変更したツイートを保存
        $tweet->save();
        
        return redirect()
            ->route('tweet.update.index', ['tweetId' => $tweet->id])
            ->with('feedback.success', "つぶやきを編集しました");
    }
}
