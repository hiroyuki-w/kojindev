@extends('layout.app')
@section('titleTag', 'アプリケーション開発報告')
@section('navCategoryName', 'アプリケーション')
@section('navPageName', '開発報告')

@section('mainContents')


    <section class="section">
        <h2 class="head-title head-title--section-title">報告入力</h2>
        <div class="content">

            <div class="input-form mt-30">
                {{Form::open(['method'=>'post','route' => ['application.report.store','trApplication' => $trApplication->id],'class' => 'input-form__formtag'])}}
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label class="input-form__label">レポート種別</label>
                    <p class="input-form__error-message {{$errors->first('report_type') ? 'has-error':'' }}">
                        {{$errors->first('report_type')}}</p>
                    {{Form::select('report_type',collect(\App\Models\TrApplicationReport::REPORT_TYPE)->pluck('name','key'),null,['class' => 'input-form__input input-form__input--w50per'])}}


                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label class="input-form__label">レポートタイトル</label>
                    <p class="input-form__error-message {{$errors->first('report_title') ? 'has-error':'' }}">
                        {{$errors->first('report_title')}}</p>
                    <input placeholder="ex)◯◯機能をリリースしました。" type="text" name="report_title"
                           class="input-form__input input-form__input--w50per"
                           value="{{old('report_title')}}">
                </div>

                <div class="input-form__item">
                    <div>
                        <span class="badge badge--required">必須</span><label class="input-form__label">レポート内容</label>
                        <p class="input-form__error-message {{$errors->first('report_text') ? 'has-error':'' }}">
                            {{$errors->first('report_text')}}</p>
                        <textarea placeholder="ex)◯◯機能をリリースしましたので、ぜひ使ってみてください。"
                                  name="report_text"
                                  class="input-form__input input-form__input--h200px">{{old('report_text')}}</textarea>
                    </div>
                </div>


                <div class="input-form__submit">
                    <button type="submit" class="button button--default">投稿する</button>
                </div>

                {{ Form::close() }}
            </div>


@endsection
