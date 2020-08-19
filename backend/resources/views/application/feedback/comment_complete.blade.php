@extends('layout.app')
@section('navCategoryName', $trFeedback->tr_application->application_name)
@section('navPageName', 'フィードバック')
@section('mainContents')

    <section class="section">
        <div class="content">
            <h2 class="head-title head-title--section-title">フィードバック投稿完了</h2>
            <div class="content content--complete">
                <div>
                    @if($trFeedback->tr_application->tr_user->tr_user_profile->twitter_account)
                        ツイートでアプリケーション作成者にフィードバックしたことを連絡しましょう。
                        <a target="_blank"
                           href="http://twitter.com/share?text=&url={{get_feed_back_tweet_text(
                            $trFeedback->tr_application->tr_user->tr_user_profile->twitter_account,
                            $trFeedback->tr_application->application_name.'をレビューしました',
                            route('feedback.show',['trFeedback'=>$trFeedback]))}}&hashtags=個人開発">
                            <button class="button button--default"><i class="icon-font icon-font--twitter"></i>ツイートする
                            </button>
                        </a>
                    @endif
                </div>
                <div class="mt-30">
                    <a href="{{route('feedback.show',[$trFeedback])}}">
                        戻る
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
