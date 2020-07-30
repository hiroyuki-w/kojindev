@extends('layout/app')
@section('titleTag', '個人開発者のためのコミュニティ。アプリケーションの告知、宣伝をしよう。')
@section('navContents')

@endsection
@section('mainContents')
    @if(Auth::guest())
        <section class="first-view">

            <div class="first-view__message">
                <h1 class="first-view__catch">個人開発者コミュニティー</h1>
                <h2 class="first-view__sub-catch">１人でWEBサービス、スマホアプリなどを開発している個人開発者のコミュニティ</h2>
                <div class="first-view__login-form">
                    <p>会員登録・ログイン</p>
                    <div>
                        <a href="{{route('social.login',['provider' => 'google'])}}">
                            <button class="button button--login">Google</button>
                        </a>
                    </div>

                    <div>
                        <a href="{{route('social.login',['provider' => 'twitter'])}}">
                            <button class="button button--login">Twitter</button>
                        </a>
                    </div>

                    <div>
                        <a href="{{route('social.login',['provider' => 'github'])}}">
                            <button class="button button--login">GitHub</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="first-view__ketvisual">
                <img src="/img/hero-img.png" alt="" class="img-fluid">
            </div>

        </section>
    @endif
    <section class="section">
        <div class="content">
            <h2 class="head-title head-title--section-title">「個人.dev」とは？</h2>
            <p class="u-font-size-s">
                個人でウェブサービス、ネイティブアプリケーションを個人開発している人が、自分の成果物を発表したり、リリース情報などを発表できる場です。<br><br>
                自分のアプリケーションの宣伝や、他の個人開発している人たちを見つけて交流したりすることを目的にサイトをオープンしました。<br><br>
                なお、本サイトも個人開発で運営されており、利用している技術の詳細は<a href="{{route('user.detail',['trUser' => 1])}}">こちら</a>です。

            </p>
        </div>
    </section>
    <section class="section section--backcolor-dark">
        <div class="content content--x-small-width">
            <h2 class="head-title head-title--section-title">個人開発者検索</h2>
            <p>登録されている個人開発者のプロフィールを検索</p>
            <form action="{{route('user.search')}}" method="get" class="line-form" id="js-user-search-form">
                <input name="keyword" class="line-form__input-form" id="js-user-search-input">
                <button type="button" class="line-form__submit" id="js-user-search-submit">検索</button>
            </form>
        </div>
    </section>

    <section class="section">
        <div class="content">
            <h2 class="head-title head-title--section-title">新着アプリケーション</h2>
            <p>最近登録されたアプリケーションです。</p>
            <div class="col-pc-2-mobile-1">

                @forelse($latestApplications as $application)
                    <div class="col-pc-2-mobile-1__cel col-pc-2-mobile-1__cel--padding-1">
                        <div class="application-card">

                            <div class="application-card__thumnail">
                                <a href="{{route('application.show',['trApplication' => $application->id])}}">
                                    <img
                                        src="{{current($application->application_thumbnails)}}"
                                        alt="" class="application-card__image">
                                </a>
                            </div>
                            <div class="application-card__detail">
                                <h4 class="head-title head-title--middle">
                                    <a href="{{route('application.show',['trApplication' => $application->id])}}">{{$application->application_name}}</a>
                                </h4>

                                <div class="tags-list">
                                    @foreach($application->tr_application_tags as $tag)
                                        <a href="{{route('application.search',['tag'=>$tag->tag_name])}}"><p
                                                class="tags-list__item">{{$tag->tag_name}}</p></a>
                                    @endforeach
                                </div>

                                <span class="line"></span>
                                <div class="application-card__note">開発者名：<a
                                        href="{{route('user.detail',['trUser'=>$application->tr_user_id])}}">{{$application->tr_user->user_name}}</a>
                                </div>
                                <p class="application-card__overview">
                                    {{$application->application_overview}}
                                </p>
                                <div class="social-icon-list">
                                    <a class="social-icon-list__item" href=""><i></i></a>
                                    <a class="social-icon-list__item" href=""><i></i></a>
                                    <a class="social-icon-list__item" href=""><i></i></a>
                                    <a class="social-icon-list__item" href=""> <i></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="mt-15 u-empty-content">まだ登録がありません</div>

                @endforelse

            </div>
            <div class="mt-30">
                <a href="{{route('application.search')}}">
                    <button class="button button--more">
                        もっと見る...
                    </button>
                </a>
            </div>

        </div>
    </section>
    <section class="section  section--backcolor-dark">
        <div class="content">
            <h2 class="head-title head-title--section-title">開発報告</h2>
            <p>最近の開発報告</p>
            <div class="col-pc-2-mobile-1">
                @forelse($latestReports as $report)
                    <div class="col-pc-2-mobile-1__cel col-pc-2-mobile-1__cel--padding-1">
                        <div class="application-card">

                            <div class="application-card__thumnail">
                                <a href="{{route('application.show',['trApplication'=>$report->tr_application_id])}}">
                                    <img
                                        src="{{current($report->tr_application->application_thumbnails)}}"
                                        alt=""
                                        class="application-card__image">
                                </a>
                            </div>
                            <div class="application-card__detail">
                                <a
                                    href="{{route('application.show',['trApplication'=>$report->tr_application_id])}}">
                                    <h4 class="head-title head-title--middle icon icon--{{$report->report_type_code}}">{{$report->report_title}}</h4>
                                </a>
                                <div class="application-card__note">アプリ名：<a
                                        href="{{route('application.show',['trApplication'=>$report->tr_application_id])}}">{{$report->tr_application->application_name}}</a>
                                </div>
                                <div class="application-card__note">
                                    開発者：<a
                                        href="{{route('user.detail',['trUser'=>$report->tr_application->tr_user->id])}}">{{$report->tr_application->tr_user->user_name}}</a>
                                </div>
                                <span class="line"></span>
                                <p class="application-card__overview">
                                    {{$report->report_text}}
                                </p>
                                <div class="social-icon-list">
                                    <a class="social-icon-list__item" href=""><i></i></a>
                                    <a class="social-icon-list__item" href=""><i></i></a>
                                    <a class="social-icon-list__item" href=""><i></i></a>
                                    <a class="social-icon-list__item" href=""> <i></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="mt-15 u-empty-content">まだ登録がありません</div>
                @endforelse


            </div>
        </div>
    </section>

@endsection
