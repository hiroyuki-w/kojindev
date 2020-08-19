@extends('layout/app')
@section('titleTag', $trUser->user_name)
@section('navCategoryName', '開発者情報')
@section('navPageName', $trUser->user_name)

@section('mainContents')


    <section class="section">
        <div class="content">
            <div class="col-pc-2-mobile-1--left-menu">
                <div class="col-pc-2-mobile-1__left-cel--left-menu p-5">
                    <div class="profile">
                        <div class="user-icon block-center">
                            <img src="{{$trUser->profile_image}}" class="user-icon__image">
                        </div>

                        <div class="profile__social-icon">
                            <div class="social-icon-list">
                                @if($trUser->tr_user_profile->twitter_account)
                                    <a target="_blank"
                                       href="https://twitter.com/{{$trUser->tr_user_profile->twitter_account}}"
                                       class="social-icon-list__link">
                                        <i class="social-icon-list__icon--twitter"></i>
                                    </a>
                                @endif
                                @if($trUser->tr_user_profile->git_account)
                                    <a target="_blank"
                                       href="https://github.com/{{$trUser->tr_user_profile->git_account}}"
                                       class="social-icon-list__link">
                                        <i class="social-icon-list__icon--github"></i>
                                    </a>
                                @endif
                                @if($trUser->tr_user_profile->my_url)
                                    <a target="_blank" href="{{$trUser->tr_user_profile->my_url}}"
                                       class="social-icon-list__link">
                                        <i class="social-icon-list__icon--mypage"></i>

                                    </a>
                                @endif
                            </div>
                        </div>


                        <div class="admin-action
                            @cannot('edit',$trUser)
                            display-none
                            @endcannot
                            ">
                            <div class="admin-action__list admin-action__list--center">
                                <a href="{{route('user.edit')}}" class="admin-action__item">プロフィール編集</a>
                            </div>

                        </div>


                        <dl class="profile__detail">
                            <dt class="profile__label">
                                自己紹介
                            </dt>
                            <dd class="profile__body">
                                {!! ee($trUser->tr_user_profile->user_profile) !!}
                            </dd>
                            <dt class=" profile__label">
                                スキル
                            </dt>
                            <dd class="profile__body">
                                {!! ee($trUser->tr_user_profile->user_skillset) !!}
                            </dd>

                        </dl>
                    </div>

                </div>
                <div class="col-pc-2-mobile-1__right-cel--left-menu p-5">
                    <h2 class="head-title head-title--section-title">開発プロダクト一覧</h2>
                    <p>いままで開発したアプリケーション</p>
                    <div class="admin-action
                        @cannot('edit',$trUser)
                        display-none
                        @endcannot
                        ">
                        <div class="admin-action__list admin-action__list--center">
                            <a href="{{route('application.create')}}"
                               class="admin-action__item admin-action__item--large">アプリケーションを追加する</a>
                        </div>

                    </div>
                    @forelse($applications as $application)
                        <div class="application-detail-card">
                            <div class="admin-action
                                @cannot('edit',$trUser)
                                display-none
                                @endcannot
                                ">
                                <div class="admin-action__list">
                                    <a href="{{route('application.edit',['trApplication' => $application->id])}}"
                                       class="admin-action__item">編集する</a>
                                </div>

                            </div>
                            <div class="application-detail-card__top">

                                <div class="application-detail-card__detail">
                                    <div class="application-detail-card__head">
                                        <a href="{{route('application.show',['trApplication' => $application->id])}}">
                                            <h3 class="head-title head-title--app-section-title head-title--app-title head-title--app-section-tag-{{$application->application_type_code}}">{{$application->application_name}}</h3>
                                        </a>
                                        <div class="tags-list">
                                            @foreach($application->tr_application_tags as $tag)
                                                <a href="{{route('application.search',['tag'=>$tag->tag_name])}}"><p
                                                        class="tags-list__item">{{$tag->tag_name}}</p></a>
                                            @endforeach
                                        </div>

                                        <span class="line"></span>
                                    </div>

                                    <div class="application-detail-card__overview">
                                        <p class="u-bold">{{$application->application_concept}}</p>
                                        {!! ee($application->application_overview) !!}
                                    </div>
                                </div>
                                <div class="application-detail-card__thumnail">
                                    <a href="{{route('application.show',['trApplication' => $application->id])}}"><img
                                            src="{{current($application->application_thumbnails)}}"
                                            alt="" class="img-fluid"></a>
                                </div>
                            </div>
                            <div class="application-detail-card__report">
                                <div class="admin-action
                                    @cannot('edit',$trUser)
                                    display-none
                                    @endcannot
                                    ">
                                    <div class="admin-action__list">
                                        <a target="_blank"
                                           href="http://twitter.com/share?text=&url={{route('application.show',['trApplication'=>$application->id])}}&hashtags={{$application->application_name}},個人開発"
                                           rel="nofollow"
                                           class="social-icon-list__icon--twitter admin-action__item">報告を書く</a>
                                    </div>
                                    <div>
                                        報告登録方法：プロフィールにTwitterアカウントを設定し、アプリケーション名をハッシュタグにしてツイート
                                    </div>

                                </div>

                                <div class="u-font-size-s u-bold">過去7日間のツイート(※反映に時間がかかります)</div>
                                <div class="develop-report">
                                    @forelse($applicationReports->where('tr_application_id', $application->id) as $report)
                                        <div class="develop-report__item">
                                            <h3 class="icon icon--{{$report->report_type_code}} develop-report__title js-develop-report-toggle-button">
                                                <a>{{$report->report_title}}</a>
                                            </h3>
                                            <i class="develop-report__toggle-icon js-toggle-icon rotate-180 js-develop-report-toggle-button">▲</i>

                                            <div
                                                class="develop-report__toggle js-develop-report-toggle-block
                                                @if (!$loop->first)
                                                    display-none
                                                @endif
                                                    ">
                                                {!! ee($report->report_text) !!}
                                            </div>
                                        </div>
                                    @empty
                                        <div class="mt-15 u-empty-content">
                                            報告の登録がありません<br>過去{{app('App\Services\Twitter\GetTweetService')::PERIOD_TWEET_REPORT_DAY}}
                                            日間のツイートを表示します
                                        </div>
                                    @endforelse
                                </div>

                            </div>
                            <div class="admin-action
                                @cannot('edit',$trUser)
                                display-none
                                @endcannot
                                ">
                                <div class="admin-action__list admin-action__list--right">
                                    <a href="" class="admin-action__item js-modal-confirm-open"
                                       target-modal="js-modal-confirm__toggle-published-flg">
                                        {{$application->public_flg == FLG_ON ? '非公開':'公開'}}に変更</a>
                                    <a href=""
                                       class="admin-action__item  admin-action__item--danger js-modal-confirm-open"
                                       target-modal="js-modal-confirm__application-delete">削除する</a>

                                    <div class="modal-confirm js-modal-confirm js-modal-confirm__toggle-published-flg">
                                        <div class="modal-confirm__bg js-modal-confirm-close"></div>
                                        <div class="modal-confirm__content">
                                            <p class="modal-confirm__title">
                                                {{$application->public_flg == FLG_ON ? '非公開':'公開'}}設定にしますか？
                                            </p>
                                            <p class="modal-confirm__message">
                                                非公開にすると、自分以外のユーザからは閲覧、検索できなくなります。こちらの画面から再び公開設定に戻すことが可能です。</p>
                                            {{Form::open(['method'=>'patch','route' => ['application.togglePublicFlg','trApplication'=>$application->id ]] )}}
                                            <input type="submit" class="button button--default mt-20"
                                                   value="{{$application->public_flg == FLG_ON ? '非公開':'公開'}}に変更">
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                    <div class="modal-confirm js-modal-confirm js-modal-confirm__application-delete">
                                        <div class="modal-confirm__bg js-modal-confirm-close"></div>
                                        <div class="modal-confirm__content">
                                            <p class="modal-confirm__title">削除しますか？</p>
                                            <p class="modal-confirm__message">
                                                【{{$application->application_name}}】に関連する情報を完全削除します。<br>
                                                過去にされた、アプリケーションに関連する報告やコメントがすべて削除されます。<br>
                                                削除後はデータをもとに戻すことはできません。</p>
                                            {{Form::open(['method'=>'delete','route' => ['application.delete','trApplication'=>$application->id ]] )}}

                                            <input type="submit" class="button button--default mt-20" value="完全に削除する">
                                            {{Form::close()}}
                                        </div><!--modal__inner-->
                                    </div>

                                </div>


                            </div>
                        </div>
                    @empty
                        <div class="mt-15 u-empty-content">まだ登録がありません</div>
                    @endforelse


                </div>


            </div>
        </div>


    </section>

@endsection
