@extends('layout.app')
@section('navCategoryName', 'アプリケーション詳細')
@section('navPageName', 'コメント投稿完了')
@section('mainContents')


    <section class="section">
        <div class="content">
            <h2 class="head-title head-title--section-title">コメント投稿完了</h2>


            <div class="content content--complete">
                <div>
                    <a href="{{route('application.show',['trApplication' => session('tr_application_id')])}}">
                        <button class="button button--default">アプリケーションページに戻る
                        </button>
                    </a>
                </div>

            </div>


        </div>


    </section>


@endsection
