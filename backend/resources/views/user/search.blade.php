@extends('layout/app')
@section('titleTag', $keyword ? $keyword.'の個人開発者一覧':'個人開発者一覧')
@section('navCategoryName', '個人開発者')
@section('navPageName', $keyword ? sprintf("「%s」の検索結果",$keyword): '検索結果')
@section('mainContents')
    <section class="section">
        <div class="content content--x-small-width">
            <h2 class="head-title head-title--section-title">個人開発者検索</h2>
            <form action="{{route('user.search')}}" method="get" class="line-form mt-10" id="js-user-search-form">
                <input name="keyword" value="{{$keyword}}" class="line-form__input-form" id="js-user-search-input">
                <button type="button" class="line-form__submit" id="js-user-search-submit">検索</button>
            </form>
        </div>
    </section>
    <section class="section">
        <div class="content">
            <div class="col-pc-2-mobile-1">
                @forelse($trUsers as $trUser )
                    <div class="col-pc-2-mobile-1__cel col-pc-2-mobile-1__cel--padding-1">
                        <div class="user-card">
                            <div class="user-card__profile">
                                <div class="profile">
                                    <div class="user-icon user-icon--wide block-center">
                                        <a href="{{route('user.detail',['trUser'=>$trUser->id])}}">
                                            <img src="{{$trUser->profile_image}}"
                                                 class="user-icon__image"></a>
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
                                </div>
                            </div>
                            <div class="user-card__detail">
                                <a href="{{route('user.detail',['trUser'=>$trUser->id])}}">
                                    <h3 class="user-card__name">{{$trUser->user_name}}</h3></a>
                                <div class="user-card__user-profile">
                                    {{$trUser->tr_user_profile->user_profile}}
                                </div>
                                <div class="user-card__application-list">
                                    <div class="user-card__application-body">
                                        <div class="user-card__application-list-title icon-font icon-font--applist">
                                            開発アプリ
                                        </div>
                                        @forelse($trUser->tr_applications->splice(0,3) as $application)
                                            <p class="icon icon--{{$application->application_type_code}} user-card__application-item">
                                                <a href="{{route('application.show',['trApplication'=>$application->id])}}">{{$application->application_name}}</a>
                                            </p>
                                        @empty
                                            登録がありません。
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="mt-15 u-empty-content">指定された条件の開発者は見つかりませんでした</div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="section">
        <div class="content">
            {{$trUsers->onEachSide(1)->links()}}
        </div>
    </section>
@endsection
