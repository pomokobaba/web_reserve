<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller; 
use App\Http\Requests\Tweet\CreateRequest;
use App\Models\Tweet;
// use Illuminate\Http\Request;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // FromRequestクラスをコントローラーで利用するため、引数に指定
    public function __invoke(CreateRequest $request)
    {
        $tweet = new Tweet;
        // user_idの保存
        $tweet->user_id = $request->userID();
        $tweet->content = $request->tweet();
        // DBに値をセット
        $tweet->save();
        // 元の画面に戻す。
        return redirect()->route('tweet.index');
    }
}
