@extends('layout/app')
@section('titleTag', 'ユーザ情報更新完了')
@section('navCategoryName', 'ユーザ')
@section('navPageName', 'ユーザ情報更新完了')
@section('mainContents')


    <section class="section">
        <div class="content">
            <h2 class="head-title head-title--section-title">ユーザ情報更新完了</h2>


            <div class="content content--complete">
                <div>
                    <a href="{{route('top')}}">
                        <a class="button button--default" href="{{route('user.detail',['trUser' => Auth::id()])}}">ユーザページに戻る</a>

                    </a>
                </div>

            </div>


        </div>


    </section>


@endsection
