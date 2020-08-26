@extends('layout/app')
@section('titleTag',$trFeedback->tr_application->application_name.' | '.'フィードバック募集')

@section('navCategoryName')
    <a href="{{route('application.show',[$trFeedback->tr_application])}}">
        {{$trFeedback->tr_application->application_name}}
    </a>
@endsection

@section('navPageName', 'フィードバック募集')
@section('twitterCard')
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site"
          content="{{$trFeedback->tr_application->tr_user->tr_user_profile->twitter_account ? '@'.$trFeedback->tr_application->tr_user->tr_user_profile->twitter_account: '@kojindev'}}"/>
    <meta property="og:url" content="{{route('feedback.show',['trFeedback'=>$trFeedback])}}"/>
    <meta property="og:title" content="{{$trFeedback->feedback_title}}"/>
    <meta property="og:description" content="{{$trFeedback->feedback_title}}"/>
    <meta property="og:image" content="{{current($trFeedback->tr_application->application_thumbnails)}}"/>
@endsection
@section('mainContents')

    <section class="section">
        <h2 class="head-title head-title--section-title">募集内容</h2>
        <div class="content mt-10">
            <div class="feedback">
                <div class="feedback--title">
                    {{$trFeedback->feedback_title}}
                </div>
                <div class="feedback--footer">
                    <div class="social-icon-list">
                        @if($trFeedback->tr_application->tr_user->tr_user_profile->twitter_account)
                            <a target="_blank"
                               href="http://twitter.com/share?text=&url={{get_feed_share_tweet_text(
                            $trFeedback->feedback_title,
                            route('feedback.show',['trFeedback'=>$trFeedback]))}}&hashtags=個人開発"
                               class="social-icon-list__link">
                                <i class="social-icon-list__icon--twitter"></i>
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <div class="content mt-10">
            <div class="input-form mt-30">
                {{Form::open(['method'=>'post','route' => ['feedback.comment.store',[$trFeedback]],'class' => 'input-form__formtag'])}}

                <div class="input-form__item">
                    <div>
                        <label class="input-form__label">あなたのフィードバックを投稿する</label>
                        <p class="input-form__error-message {{$errors->first('feedback_comment') ? 'has-error':'' }}">
                            {{$errors->first('feedback_comment')}}</p>
                        <textarea name="feedback_comment"
                                  class="input-form__input input-form__input--h200px">{{old('feedback_comment',get_feed_back_comment_default($trFeedback->question_1,$trFeedback->question_2,$trFeedback->question_3))}}</textarea>
                    </div>
                </div>

                @if(Auth::id())
                    <div class="input-form__submit">
                        <button type="submit" class="button button--default">フィードバックする</button>
                    </div>
                @else
                    <p>投稿するにはログインする必要があります。</p>
                    <a href="{{'login'}}">
                        <button type="submit" class="button button--default">ログイン/会員登録</button>
                    </a>
                @endif
                {{ Form::close() }}
            </div>

        </div>
    </section>

    <section class="section">
        <h2 class="head-title head-title--section-title">フィードバック投稿</h2>
        <div class="content mt-10">

            <div class="user-post">
                @forelse($trFeedback->tr_feedback_comments as $feedbackComment)
                    <div class="user-post__item">
                        <div class="user-post__head">
                            <p class="user-post__name">
                                <a href="{{route('user.detail',[$feedbackComment->comment_tr_user])}}">{{$feedbackComment->comment_tr_user->user_name}}</a>
                            </p>
                            <p class="user-post__date">{{$feedbackComment->created_at}}</p>
                        </div>
                        <div class="user-post__body">
                            {!! ee($feedbackComment->feedback_comment) !!}
                        </div>
                    </div>
                @empty
                    <div class="mt-15 u-empty-content">まだフィードバック投稿がありません
                    </div>
                @endforelse
            </div>

        </div>


    </section>

@endsection
