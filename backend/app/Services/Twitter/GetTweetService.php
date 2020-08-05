<?php
/**
 * // TwitterAPIリファレンス
 * https://developer.twitter.com/en/docs/tweets/search/overview
 */

namespace App\Services\Twitter;

use App\Models\TrApplication;
use App\Models\TrApplicationReport;
use App\Models\TrUserProfile;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Arr;
use Str;

class GetTweetService
{
    /**
     * @var AppOAuth
     */
    private AppOAuth $connection;
    const LIMIT_API_COUNT = 5;//APIのコール制限
    const PERIOD_TWEET_REPORT_DAY = 14;//開発報告を収集する期間
    const EXPIRES_API_ACCESS_HOUR = 3;//APIから値を再取得する制限時間

    /**
     * @var SaveTweetService
     */
    private SaveTweetService $saveTweetService;

    public function __construct(SaveTweetService $saveTweetService)
    {
        $this->saveTweetService = $saveTweetService;
        $this->connection = new AppOAuth(config('services.twitter.client_id'), config('services.twitter.client_secret'));
    }

    /**
     * ビューで利用する配列へ変換する
     * @param array $tweets
     * @param int $tr_application_id
     * @return array
     */
    private function formatted(array $tweets, int $tr_application_id): array
    {
        if (count($tweets) == 0) {
            return [];
        }
        $formatted = [];
        foreach ($tweets as $tweet) {
            $formatted[] = (object)[
                'tr_application_id' => $tr_application_id,
                'report_type_code' => TrApplicationReport::REPORT_TYPE_DEVELOP,
                'report_title' => Str::limit($tweet['text'], 50),
                'report_text' => $tweet['text'],
                'report_image' => Arr::get($tweet, 'entities.media.0.type') == 'photo' ?
                    Arr::get($tweet, 'entities.media.0.media_url_https') . ':thumb' : '',
            ];
        }
        return $formatted;
    }

    /**
     * アプリケーションのツイート情報を複数取得する
     * @param TrUserProfile $trUserProfile
     * @param Collection $trApplications
     * @param int $count
     * @return Collection
     */
    public function getApplicationTweetMany(TrUserProfile $trUserProfile, Collection $trApplications, int $count): Collection
    {
        $tweets = [];
        foreach ($trApplications as $trApplication) {
            $tweets = array_merge(
                $tweets,
                $this->getApplicationTweet($trUserProfile, $trApplication)
            );
        }
        return collect($tweets)->slice(0, $count);
    }

    /**
     * アプリケーションのツイート情報を1件取得する
     * @param TrUserProfile $trUserProfile
     * @param TrApplication $trApplication
     * @return array
     */
    public function getApplicationTweet(TrUserProfile $trUserProfile, TrApplication $trApplication): array
    {
        if (empty($trUserProfile->twitter_account)) {
            return [];
        }
        $timeLineTweet = $this->getTimeLine($trUserProfile->twitter_account, Carbon::now()->subDay(self::PERIOD_TWEET_REPORT_DAY));
        $reportTweet = $this->filterTimeline($timeLineTweet, $trApplication);

        return $this->formatted($reportTweet, $trApplication->id);
    }

    /**
     * ユーザのタイムライン情報取得
     * @param string $account
     * @param Carbon $limitDate
     * @return array
     */
    private function getTimeLine(string $account, Carbon $limitDate): array
    {
        $param = [
            'count' => 200,
            'screen_name' => $account,
        ];
        $savedData = $this->saveTweetService->get($account);
        if (!empty($savedData)) {
            $savedTime = $savedData['saved_datetime'];
            $nowTime = Carbon::now();

            //前回保存時間がN時間以内ならAPIアクセスせずに取得
            if ($savedTime->diffInDays($nowTime) <= self::EXPIRES_API_ACCESS_HOUR) {
                return $savedData;
            }
        }

        //N時間以上経過ならAPIから最新のデータを追加で取得
        //取得期間に到達するか、キャッシュしているデータの先頭まで取得したらAPIからの取得終了
        $tweetLeastId = Arr::get($savedData, '0.id');
        $apiCount = 0;
        $max_id = 0;
        while (1) {
            $tweetData = $this->connection->get('statuses/user_timeline', $param);
            $apiCount++;
            if ($apiCount > self::LIMIT_API_COUNT) {
                break;
            }
            if (empty($tweetData)) {
                break;
            }
            foreach ($tweetData as $tweet) {
                //twitterAPIのタイムゾーンがUTCのため変換
                $tweet_created_at = Carbon::create($tweet['created_at'])->timezone(config('app.timezone'));
                //ツイート時間が$limitDate日以下かどうか
                if ($tweet_created_at->lte($limitDate)) {
                    //$tweet_created_atが$limitDate日、以下の日付
                    break 2;
                }
                //保存しているデータの先頭まで到達したか
                if ($tweet['id'] == $tweetLeastId) {
                    //到達している
                    break 2;
                }
                array_push($savedData, $tweet);
                $max_id = $tweet['id'];
            }
            $param['max_id'] = $max_id - 1;
        }
        $this->saveTweetService->put($account, $param, $savedData);
        return $savedData;
    }

    /**
     * ツイートをタグでフィルタリング
     * @param array $timeLineTweets
     * @param TrApplication $trApplication
     * @return array
     */
    private function filterTimeline(array $timeLineTweets, TrApplication $trApplication): array
    {
        $filteredTweet = [];
        foreach ($timeLineTweets as $tweet) {
            $hashtagsEntities = Arr::get($tweet, 'entities.hashtags', []);
            $hashtags = array_column($hashtagsEntities, 'text', null);
            if (in_array($trApplication->application_name, $hashtags)) {
                $filteredTweet[] = $tweet;
            }
        }
        return $filteredTweet;
    }
}
