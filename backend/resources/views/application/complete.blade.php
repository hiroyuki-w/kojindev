@extends('layout/app')
@section('titleTag', 'アプリケーション編集完了')
@section('navCategoryName', 'アプリケーション')
@section('navPageName', '編集完了')
@section('mainContents')


    <section class="section">
        <div class="content">
            <h2 class="head-title head-title--section-title">アプリケーション追加完了</h2>


            <div class="content content--complete">
                <div>
                    <a href="{{route('user.me')}}">
                        <button class="button button--default">マイページに戻る
                        </button>
                    </a>
                </div>

            </div>


        </div>


    </section>


@endsection
