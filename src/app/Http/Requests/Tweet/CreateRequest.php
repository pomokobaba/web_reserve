<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * ユーザ情報を判断して、このリクエストを認証できるか判断させることができる。
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // 誰でもリクエストできる
    }

    /**
     * Get the validation rules that apply to the request.
     * リクエストされた値の検証をする。
     * 
     * @return array　// 配列を返却
     */
    public function rules()
    {
        return [
            'tweet' => 'required|max:140',  //必須か最大値140文字
            'images' => 'array|max:4',      //
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ];
    }

    /**
     * 今ログインしているユーザーの取得
     *
     */
    public function userId(): int
    {
        return $this->user()->id;
    }

    /**
     * 投稿されたデータの取得
     * 引数１に取得する名前、引数２に取得できない場合の初期値
     * ※今回はつぶやきは必須なので、引数２は省略
     *
     * @return string
     */
    public function tweet(): string
    {
        return $this->input('tweet');
    }

    /**
     * 画像の取得
     *
     * @return array
     */
    public function images(): array
    {
        return $this->file('images', []);
    }
}
