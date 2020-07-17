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

