<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // メンテナスモードの時は全てのアクセスをリダイレクトする
        // ログインしているユーザのみにアクセス制限をする
        // 特定のIPアドレスからのアクセスできるようにアクセス制限をする
        // ユーザからのリダイレクトされたデータに一律で変換を追加する
        return $next($request);
        // 全てのHTTPレスポンスに必ず特定のレスポンスヘッダーをつけるようにする
        // 全てのHTTPに不随するCookieを暗号化する
        // 処理の実行時間を計測してログを出す
    }
}
