<?php
/**
 * ヘルパー関数
 */

/**
 * ユーザの投稿を独自エスケープして表示する
 * ・URL形式の文字列を外部リンクに変換
 * ・改行コードは<br>に変換
 *
 * @param $string
 * @return string
 */
function ee($string)
{
    $string = e($string);

    //URL形式の文字列を外部リンクに変換
    $pattern = '/((?:https?):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/s';
    $replace = '<a target="_blank" href="$1">$1</a>';
    $string = preg_replace($pattern, $replace, $string);

    //改行を<br>タグ
    $string = nl2br($string);

    return $string;
}

/**
 * フィードバック投稿完了後のツイートボタンに設定するテキストパラメータ
 * @param $account
 * @param $message
 * @param $url
 * @return string
 */
function get_feed_back_tweet_text($account, $message, $url)
{
    $text = '';
    $text .= $message . "\n\n";
    $text .= '@' . $account . " さんへ\n";
    $text .= $url . "\n";
    return urlencode($text);
}

function get_feed_share_tweet_text($message, $url)
{
    $text = '';
    $text .= $message . "\n\n";
    $text .= $url . "\n";
    return urlencode($text);
}

/**
 * フィードバックコメントのデフォルトテキスト
 * @param $no1
 * @param $no2
 * @param $no3
 * @return string
 */
function get_feed_back_comment_default($no1, $no2, $no3)
{
    $text = '【' . $no1 . '】';
    if ($no2) {
        $text .= "\n\n\n" . '【' . $no2 . '】';
    }
    if ($no3) {
        $text .= "\n\n\n" . '【' . $no3 . '】';
    }
    return $text;
}
