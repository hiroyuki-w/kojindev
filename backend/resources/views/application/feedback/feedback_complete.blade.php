@extends('layout.app')
@section('navCategoryName', 'アプリケーション詳細')
@section('navPageName', 'フィードバック募集')
@section('mainContents')


    <section class="section">
        <div class="content">
            <h2 class="head-title head-title--section-title">完了</h2>

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
