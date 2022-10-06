<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // DBから値を取得するときに、作成の降順で取得する
        $tweets = Tweet::orderBy('created_at', 'DESC')->get();
        return view('tweet.index')
            ->with('tweets', $tweets);
    }
}