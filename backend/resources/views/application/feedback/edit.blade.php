@extends('layout/app')
@section('titleTag', 'アプリケーション名')

@section('navCategoryName', 'アプリケーション名')
@section('navPageName', 'フィードバック')

@section('mainContents')

    <section class="section">
        <h2 class="head-title head-title--section-title">フィードバック募集</h2>
        <div class="content mt-10">
            <div class="input-form mt-30">
                {{Form::open(['method'=>'post','route' => ['feedback.store',[$trApplication,$trFeedback]],'class' => 'input-form__formtag'])}}
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label
                        class="input-form__label">募集タイトル(42文字まで)</label>
                    <p class="input-form__error-message {{$errors->first('feedback_title') ? 'has-error':'' }}">{{$errors->first('feedback_title')}}</p>
                    <textarea placeholder="ex)UIについて意見もらえる人募集"
                              name="feedback_title"
                              class="input-form__input input-form__input--h5em">{{old('feedback_title',$trFeedback->feedback_title)}}</textarea>
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label
                        class="input-form__label">設問１(20文字まで)</label>
                    <p class="input-form__error-message {{$errors->first('question_1') ? 'has-error':'' }}">{{$errors->first('question_1')}}</p>
                    <textarea placeholder="ex)使いにくい点はありますか？"
                              name="question_1"
                              class="input-form__input input-form__input--h5em">{{old('question_1',$trFeedback->question_1)}}</textarea>
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label
                        class="input-form__label">設問２(20文字まで)</label>
                    <p class="input-form__error-message {{$errors->first('question_2') ? 'has-error':'' }}">{{$errors->first('question_2')}}</p>
                    <textarea placeholder="ex)文字の大きさが大きすぎ、小さすぎなどありますか？"
                              name="question_2"
                              class="input-form__input input-form__input--h5em">{{old('question_2',$trFeedback->question_2)}}</textarea>
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label
                        class="input-form__label">設問３(20文字まで)</label>
                    <p class="input-form__error-message {{$errors->first('question_3') ? 'has-error':'' }}">{{$errors->first('question_3')}}</p>
                    <textarea placeholder="ex)率直に言って、良いデザインだと思いますか？"
                              name="question_3"
                              class="input-form__input input-form__input--h5em">{{old('question_3',$trFeedback->question_3)}}</textarea>
                </div>


                <div class="input-form__submit">
                    <button type="submit" class="button button--default">募集する</button>
                </div>

                {{Form::close()}}
            </div>

        </div>
    </section>


@endsection
