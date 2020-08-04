<?php
/**
 * ツイートをファイル保存
 */

namespace App\Services\Twitter;


use Carbon\Carbon;
use Storage;

class SaveTweetService
{
    const BASE_PATH = 'twitter_timeline';

    /**
     * ストレージファイルから取得
     * @param string $account
     * @param array $param
     * @return array
     */
    public function get(string $account): array
    {
        $savedFileName = self::BASE_PATH . '/' . $account;
        $savedData = [];
        if (Storage::disk('local')->exists($savedFileName)) {
            $savedData = unserialize(Storage::disk('local')->get($savedFileName));
        }
        return $savedData;
    }

    /**
     * ストレージファイルに保存
     * @param string $account
     * @param array $param
     * @param string $data
     */
    public function put(string $account, array $param, array $data)
    {
        $savedFileName = self::BASE_PATH . '/' . $account;
        $data['saved_datetime'] = Carbon::now();
        Storage::disk('local')->put($savedFileName, serialize($data));
    }
}
