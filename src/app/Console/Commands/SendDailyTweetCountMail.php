<?php

namespace App\Console\Commands;

use App\Mail\DailyTweetCount;
use App\Models\User;
use App\Services\TweetService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailer;

class SendDailyTweetCountMail extends Command
{
    /**
     * The name and signature of the console command.
     * コンソール コマンドの名前と署名
     *
     * @var string
     */
    protected $signature = 'mail:send-daily-tweet-count-mail';

    /**
     * The console command description.
     * コンソールコマンドの説明
     *
     * @var string
     */
    protected $description = '前日のつぶやき数を集計してつぶやきを促すメールを送ります。';

    private TweetService $tweetService;
    private Mailer $mailer;

    /**
     * Create a new command instance.
     * インスタンスの作成
     *
     * @return void
     */
    public function __construct(TweetService $tweetService, Mailer $mailer)
    {
        parent::__construct();
        $this->tweetService = $tweetService;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     * コンソールコマンドを実行した際の、処理内容
     *
     * @return int
     */
    public function handle()
    {
        $tweetCount = $this->tweetService->countYesterdayTweets();

        $users = User::get();

        foreach ($users as $user) {
            $this->mailer->to($user->email)
                ->send(new DailyTweetCount($user, $tweetCount));
        }

        return 0;
    }
}
