@extends('layout/app',['canonical' => '/'])
@section('navContents')

@endsection
@section('mainContents')

    <section class="first-view">

        <div class="first-view__message">
            <h1 class="first-view__catch">ログイン/会員登録する</h1>
            <h2 class="first-view__sub-catch">１人でWEBサービス、スマホアプリなどを開発している個人開発者のコミュニティ</h2>
            <p>他の開発者からのフィードバックを募集できる</p>
            <div class="first-view__login-form">
                <p>ログイン</p>
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

@endsection
