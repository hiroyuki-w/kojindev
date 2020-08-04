<?php

namespace App\Services\Twitter;

//キャッシュのデフォルトタイプはAPCキャッシュ
use Cache;

/**
 * Twitter Application-only authentication
 * https://dev.twitter.com/oauth/application-only
 *
 * @author sizaki30
 * @license MIT
 */
class AppOAuth
{
    private $_bearer_token;
    const CACHE_PREFIX = 'cache_twitter_app_oauth';

    /**
     * APIに必要な初期処理
     * トークンは永続キャッシュを行う
     * AppOAuth constructor.
     * @param $consumer_key
     * @param $consumer_secret
     */
    public function __construct($consumer_key, $consumer_secret)
    {
        $cache_key = self::CACHE_PREFIX . serialize([$consumer_key, $consumer_secret]);
        $this->_bearer_token = Cache::get($cache_key, function () use ($cache_key, $consumer_key, $consumer_secret) {
            $token = $this->_getBearerToken($consumer_key, $consumer_secret);
            Cache::forever($cache_key, $token);
            return $token;
        });
    }

    /**
     * APIトークン取得
     * @param $consumer_key
     * @param $consumer_secret
     * @return mixed
     */
    private function _getBearerToken($consumer_key, $consumer_secret)
    {
        $oauth2_url = 'https://api.twitter.com/oauth2/token';

        $token = base64_encode(urlencode($consumer_key) . ':' . urlencode($consumer_secret));

        $request = array(
            'grant_type' => 'client_credentials'
        );

        $opts['http'] = array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded;charset=UTF-8' . "\r\n"
                . 'Authorization: Basic ' . $token,
            'content' => http_build_query($request, '', '&', PHP_QUERY_RFC3986)
        );
        $context = stream_context_create($opts);

        $response_json = file_get_contents($oauth2_url, false, $context);

        $response_arr = json_decode($response_json, true);

        return $response_arr['access_token'];
    }

    /**
     * APIの実行
     * @param $api
     * @param array $params
     * @return false|string
     */
    public function get($api, $params = array())
    {
        $api_url = 'https://api.twitter.com/1.1/' . $api . '.json';

        if ($params) {
            $request = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
            $api_url .= '?' . $request;
        }

        $opts['http'] = array(
            'header' => 'Authorization: Bearer ' . $this->_bearer_token
        );

        $context = stream_context_create($opts);

        return json_decode(file_get_contents($api_url, false, $context), JSON_UNESCAPED_UNICODE);
    }
}
