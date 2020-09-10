@extends('layout/app')
@section('titleTag', $tag ? $tag: '個人開発 検索結果')
@section('navCategoryName', 'アプリケーション')
@section('navPageName', $tag ? sprintf("「%s」の検索結果",$tag): '検索結果')
@section('mainContents')

    <section class="section">
        <div class="content">

            <div class="col-pc-2-mobile-1">

                @forelse($trApplications as $application)
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


        </div>
    </section>
    <section class="section">
        <div class="content">
            {{$trApplications->links()}}
        </div>
    </section>

@endsection
