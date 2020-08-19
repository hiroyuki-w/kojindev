@extends('layout/app')
@section('titleTag', $trApplication->application_name)

@section('navCategoryName', 'アプリケーション')
@section('navPageName', $trApplication->application_name)

@section('mainContents')


    <section class="section">
        <div class="content">
            <h2 class="head-title head-title--app-section-title head-title--app-title head-title--app-section-tag-{{$trApplication->application_type_code}}">{{$trApplication->application_name}}</h2>
            <p>{{$trApplication->application_concept}}</p>
            <div class="col-pc-3-mobile-1 col-pc-3-mobile-1--center">
                @foreach($trApplication->application_thumbnails as $image)
                    <div class="col-pc-3-mobile-1__cel col-pc-3-mobile-1__cel--padding-15">
                        <img class="img-fluid" src="{{$image}}">
                    </div>
                @endforeach
            </div>
            <div>
                開発者：<a
                    href="{{route('user.detail',['trUser'=>$trApplication->tr_user_id])}}">{{$trApplication->tr_user->user_name}}</a>
            </div>
        </div>


    </section>
    <section class="section--backcolor-dark">
        <div class="content content--small-width">
            <div class="application-spec">
                <div class="application-spec__item">
                    <h4 class="application-spec__title application-spec__icon application-spec__icon--overview">
                        概要
                    </h4>
                    <div class="application-spec__description">
                        <p>
                            <i class=" fas fa-lg fa-external-link-alt"></i>
                            <a href="{{$trApplication->application_url}}">{{$trApplication->application_url}}</a></p>
                        {!! ee($trApplication->application_overview) !!}
                    </div>
                </div>
                <div class="application-spec__item">
                    <h4 class="application-spec__title application-spec__icon application-spec__icon--tech">
                        利用している技術
                    </h4>
                    <p class="application-spec__description">
                        {!! ee($trApplication->used_technology) !!}
                    </p>
                </div>
                @if($trApplication->pr_message)
                    <div class="application-spec__item">
                        <h4 class="application-spec__title application-spec__icon application-spec__icon--pr">
                            サービスのPR点
                        </h4>
                        <p class="application-spec__description">
                            {!! ee($trApplication->pr_message) !!}
                        </p>
                    </div>
                @endif
                @if($trApplication->additional_features)
                    <div class="application-spec__item">
                        <h4 class="application-spec__title application-spec__icon application-spec__icon--features">
                            今後の追加機能など
                        </h4>
                        <p class="application-spec__description">
                            {!! ee($trApplication->additional_features) !!}
                        </p>
                    </div>
                @endif

                @if($trApplication->other_message)
                    <div class="application-spec__item">
                        <h4 class="application-spec__title application-spec__icon application-spec__icon--other">
                            その他メッセージ
                        </h4>
                        <p class="application-spec__description">
                            {!! ee($trApplication->other_message ?? '特になし') !!}
                        </p>
                    </div>
                @endif
            </div>

        </div>

    </section>
    <section class="section">
        <h2 class="head-title head-title--section-title">開発報告</h2>
        <p>開発者からのリリース報告などのコメントです</p>
        <div class="content content--small-width">

            <div class="u-font-size-s u-bold mt-10">
                過去{{app('App\Services\Twitter\GetTweetService')::PERIOD_TWEET_REPORT_DAY}}日間のツイート(※反映に時間がかかります)
            </div>
            <div class="social-icon-list">
                @if($trApplication->tr_user->tr_user_profile->twitter_account)
                    <a target="_blank"
                       href="https://twitter.com/{{$trApplication->tr_user->tr_user_profile->twitter_account}}"
                       class="social-icon-list__link">
                        <i class="social-icon-list__icon--twitter"></i>
                    </a>
                @endif
            </div>
            <div class="develop-report">
                @forelse($reports as $report)
                    <div class="develop-report__item">
                        <h3 class="icon icon--{{$report->report_type_code}} develop-report__title js-develop-report-toggle-button">
                            <a>{{$report->report_title}}</a>
                        </h3>
                        <i class="develop-report__toggle-icon js-toggle-icon rotate-180 js-develop-report-toggle-button">▲</i>

                        <div class="develop-report__toggle js-develop-report-toggle-block
                        @if (!$loop->first)
                            display-none
                        @endif
                            ">
                            {!! ee($report->report_text) !!}
                            @if($report->report_image)
                                <p><img src="{{$report->report_image}}" class="img-fluid"></p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="mt-15 u-empty-content">開発報告がありません<br>過去7日間のツイートを表示します</div>
                @endforelse
            </div>

        </div>
    </section>
    <section class="section">
        <h2 class="head-title head-title--section-title">コメント</h2>
        <p>サービスの利用者などからのフィードバックコメントです</p>
        <div class="content">

            <div class="user-post">
                @forelse($comments as $comment)
                    <div class="user-post__item">
                        <div class="user-post__head">
                            <p class="user-post__name">
                                @if($comment->tr_user->id)
                                    <a href="{{route('user.detail',['trUser'=>$comment->tr_user->id])}}">{{$comment->user_name}}</a>
                                @else
                                    {{$comment->user_name}}
                                @endif
                            </p>
                            <p class="user-post__date">{{$comment->registed_at}}</p>
                        </div>
                        <div class="user-post__body">
                            {!! ee($comment->post_comment) !!}
                        </div>
                    </div>
                @empty
                    <div class="mt-15 u-empty-content">まだコメントがありません</div>
                @endforelse
            </div>
            <div class="input-form mt-30">
                {{Form::open(['route' => ['application.comment.store',$trApplication->id],'class' => 'input-form__formtag'])}}

                <div class="input-form__item">
                    <div>
                        <label class="input-form__label">コメント</label>
                        <p class="input-form__error-message {{$errors->first('post_comment') ? 'has-error':'' }}">
                            {{$errors->first('post_comment')}}</p>
                        <textarea name="post_comment"
                                  class="input-form__input input-form__input--h200px">{{old('post_comment')}}</textarea>
                    </div>
                </div>


                <div class="input-form__submit">
                    <button type="submit" class="button button--default">コメントする</button>
                </div>

                {{ Form::close() }}
            </div>


        </div>

    </section>

@endsection
