@extends('layout/app')
@section('navContents')

@endsection
@section('mainContents')

    <section class="first-view">

        <div class="first-view__message">
            <h1 class="first-view__catch">ログインする</h1>
            <h2 class="first-view__sub-catch">１人でWEBサービス、スマホアプリなどを開発している個人開発者のコミュニティ</h2>
            <div class="first-view__login-form">
                <p>ログイン</p>
                <a href="{{route('social.login',['provider' => 'google'])}}" class="button button--login">
                    Google
                </a>
                <!--
                <a class="button button--login">
                    Twitter
                </a>
                -->
                <a href="{{route('social.login',['provider' => 'github'])}}" class="button button--login">
                    GitHub
                </a>
            </div>
        </div>
        <div class="first-view__ketvisual">
            <img src="/img/hero-img.png" alt="" class="img-fluid">
        </div>

    </section>

@endsection
