<?php
/**
 * キャッシュ保存先はAPCキャッシュを利用する
 */

namespace App\Services\Twitter;


use Cache;

class CacheTweetService
{
    const CACHE_PREFIX = 'cache_tweet_search';
    const CACHE_EXPIRE_MINUTES = 60 * 6;//6時間のキャッシュ

    /**
     * キャッシュキーの取得
     * @param array $param
     * @return string
     */
    private function getCacheKey(array $param): string
    {
        return self::CACHE_PREFIX . serialize($param);
    }

    /**
     * キャッシュから取得
     * @param int $tr_application_id
     * @param array $param
     * @return array|mixed
     */
    public function get(int $tr_application_id, array $param): string
    {
        $data = Cache::tags([$tr_application_id])->get($this->getCacheKey($param));
        return (string)$data;
    }

    /**
     * キャッシュに保存
     * @param int $tr_application_id
     * @param array $param
     * @param string $tweetData
     */
    public function put(int $tr_application_id, array $param, string $tweetData)
    {
        Cache::tags([$tr_application_id])->put($this->getCacheKey($param), $tweetData, self::CACHE_EXPIRE_MINUTES);
    }

    /**
     * キャッシュ削除
     * @param $tr_application_id
     */
    public function clear(int $tr_application_id)
    {
        Cache::tags([$tr_application_id])->flush();
    }
}
