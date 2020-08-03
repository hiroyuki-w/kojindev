<?php
/**
 * // TwitterAPIリファレンス
 * https://developer.twitter.com/en/docs/tweets/search/overview
 */

namespace App\Services\Twitter;


use App\Models\TrApplication;
use App\Models\TrApplicationReport;
use App\Models\TrUserProfile;
use Illuminate\Support\Collection;
use Arr;
use Str;

class GetTweetService
{

    /**
     * @var TwitterAppOAuth
     */
    private AppOAuth $connection;
    private array $query = ['q' => ''];
    /**
     * @var CacheTweetService
     */
    private CacheTweetService $cacheTweetService;

    public function __construct(CacheTweetService $cacheTweetService)
    {
        $this->cacheTweetService = $cacheTweetService;
        $this->connection = new AppOAuth(config('services.twitter.client_id'), config('services.twitter.client_secret'));
    }

    /**
     * ツイッターAPI検索実行(結果をキャッシュする）
     * @param int $tr_application_id
     * @return array
     */
    private function search(int $tr_application_id): array
    {
        $param = [
            'result_type' => 'recent',
        ];
        $param = array_merge($param, $this->getQuery());

        $tweetData = $this->cacheTweetService->get($tr_application_id, $param);
        if (empty($tweetData)) {
            $tweetData = $this->connection->get('search/tweets', $param);
            $this->cacheTweetService->put($tr_application_id, $param, $tweetData);
        }

        return json_decode($tweetData, JSON_UNESCAPED_UNICODE);
    }

    /**
     * ツイッターAPI検索条件指定：アカウントで絞る
     * @param $account_name
     * @return GetTweetService
     */
    private function filterTwitterAccount($account_name): GetTweetService
    {
        $this->query['q'] .= "from:{$account_name} ";
        return $this;
    }

    /**
     * ツイッターAPI検索条件指定：ハッシュタグで絞る
     * @param $tag
     * @return GetTweetService
     */
    private function filterHashTag($tag): GetTweetService
    {
        $this->query['q'] .= "#{$tag}";
        return $this;
    }

    /**
     * ツイッターAPI検索条件指定：取得件数を設定する
     * @param $count
     * @return GetTweetService
     */
    private function setLimit($count): GetTweetService
    {
        $this->query['count'] = $count;
        return $this;
    }

    /**
     * 構築したツイッター検索条件テキストを取得
     * @return array|string[]
     */
    private function getQuery(): array
    {
        return $this->query;
    }

    /**
     * ビューで利用する配列へ変換する
     * @param array $res
     * @param int $tr_application_id
     * @return array
     */
    private function formatted(array $res, int $tr_application_id): array
    {
        $tweets = Arr::get($res, 'statuses', []);
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
                $this->getApplicationTweet($trUserProfile, $trApplication, $count)
            );
        }
        return collect($tweets);
    }

    /**
     * アプリケーションのツイート情報を1件取得する
     * @param TrUserProfile $trUserProfile
     * @param TrApplication $trApplication
     * @param int $count
     * @return array
     */
    public function getApplicationTweet(TrUserProfile $trUserProfile, TrApplication $trApplication, int $count): array
    {
        if (empty($trUserProfile->twitter_account)) {
            return [];
        }
        try {
            $tweetData = $this
                ->filterTwitterAccount($trUserProfile->twitter_account)
                ->filterHashTag($trApplication->application_name)
                ->setLimit($count)
                ->search($trApplication->id);
        } catch (\Exception $e) {
            $tweetData = [];
        }


        return $this->formatted($tweetData, $trApplication->id);

    }
}
