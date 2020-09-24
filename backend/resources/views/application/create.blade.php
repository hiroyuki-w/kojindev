@extends('layout/app')
@section('titleTag', 'アプリケーション追加/編集')
@section('navCategoryName', 'アプリケーション')
@section('navPageName', '追加/編集')

@section('mainContents')
    <div class="section">
        <h2 class="head-title head-title--section-title">アプリケーション情報入力</h2>
        <div class="content">

            <div class="input-form mt-30">
                {{Form::open(['method'=>'post','files' => true,'route' => ['application.store',['trApplication' => $trApplication->id]],'class' => 'input-form__formtag'])}}
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label
                        class="input-form__label">アプリケーション名(30文字)</label>
                    <p class="input-form__error-message {{$errors->first('application_name') ? 'has-error':'' }}">
                        {{$errors->first('application_name')}}</p>
                    <input placeholder="ex)個人dev" type="text" name="application_name"
                           class="input-form__input input-form__input--w50per"
                           value="{{old('application_name',$trApplication->application_name)}}">
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label
                        class="input-form__label  input-form__input--w50per">アプリケーションURL</label>
                    <p class="input-form__error-message {{$errors->first('application_url') ? 'has-error':'' }}">
                        {{$errors->first('application_url')}}</p>
                    <input placeholder="https://" type="text" name="application_url"
                           class="input-form__input  input-form__input--w50per"
                           value="{{old('application_url',$trApplication->application_url)}}">
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label
                        class="input-form__label  input-form__input--w50per">タグ</label>
                    <p class="input-form__error-message {{$errors->first('tags') ? 'has-error':'' }}">
                        {{$errors->first('tags')}}</p>
                    <input placeholder="PHP MySQL" type="text" name="tags"
                           class="input-form__input  input-form__input--w50per tagsinput"
                           id="tags"
                           value="{{old('tags',$trApplication->tr_application_tags->pluck('tag_name')->implode(','))}}">
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label
                        class="input-form__label">アプリケーションPR説明(64文字)</label>
                    <p class="input-form__error-message {{$errors->first('application_concept') ? 'has-error':'' }}">
                        {{$errors->first('application_concept')}}</p>
                    <input placeholder="ex)個人開発者のためのコミュニティ" type="text" name="application_concept"
                           class="input-form__input input-form__input--w50per"
                           value="{{old('application_concept',$trApplication->application_concept)}}">
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label class="input-form__label">アプリケーション形式</label>
                    <p class="input-form__error-message {{$errors->first('application_type') ? 'has-error':'' }}">
                        {{$errors->first('application_type')}}</p>
                    {{Form::select('application_type',collect(\App\Models\TrApplication::APPLICATION_TYPE)->pluck('name','key'),$trApplication->application_type,['class' => 'input-form__input input-form__input--w50per'])}}


                </div>
                <div class="input-form__item">
                    <div>
                        <span class="badge badge--required">必須</span><label
                            class="input-form__label">アプリケーション概要(200文字)</label>
                        <p class="input-form__error-message {{$errors->first('application_overview') ? 'has-error':'' }}">
                            {{$errors->first('application_overview')}}</p>
                        <textarea placeholder="ex)アプリケーションの機能や、利用者のターゲットなど"
                                  name="application_overview"
                                  class="input-form__input input-form__input--h200px">{{old('application_overview',$trApplication->application_overview)}}</textarea>
                    </div>
                </div>
                <div class="input-form__item">
                    <div>
                        <span class="badge badge--required">必須</span><label
                            class="input-form__label">利用してる技術(500文字)</label>
                        <p class="input-form__error-message {{$errors->first('used_technology') ? 'has-error':'' }}">
                            {{$errors->first('used_technology')}}</p>
                        <textarea placeholder="ex)利用言語や、DBの種類、サーバの種類など"
                                  name="used_technology"
                                  class="input-form__input input-form__input--h200px">{{old('used_technology',$trApplication->used_technology)}}</textarea>
                    </div>
                </div>
                <div class="input-form__item">
                    <div>
                        <span class="badge badge--optional">任意</span><label
                            class="input-form__label">アプリケーションPR点(500文字)</label>
                        <p class="input-form__error-message {{$errors->first('pr_message') ? 'has-error':'' }}">
                            {{$errors->first('pr_message')}}</p>
                        <textarea placeholder="ex)注目ほしい点や、ユニークなところ"
                                  name="pr_message"
                                  class="input-form__input input-form__input--h200px">{{old('pr_message',$trApplication->pr_message)}}</textarea>
                    </div>
                </div>
                <div class="input-form__item">
                    <div>
                        <span class="badge badge--optional">任意</span><label
                            class="input-form__label">今後の予定(500文字)</label>
                        <p class="input-form__error-message {{$errors->first('additional_features') ? 'has-error':'' }}">
                            {{$errors->first('additional_features')}}</p>
                        <textarea placeholder="ex)現在開発中の機能や、今後追加予定の機能など"
                                  name="additional_features"
                                  class="input-form__input input-form__input--h200px">{{old('additional_features',$trApplication->additional_features)}}</textarea>
                    </div>
                </div>
                <div class="input-form__item">
                    <div>
                        <span class="badge badge--optional">任意</span><label class="input-form__label">その他(500文字)</label>
                        <p class="input-form__error-message {{$errors->first('other_message') ? 'has-error':'' }}">
                            {{$errors->first('other_message')}}</p>
                        <textarea placeholder="ex)現在開発中の機能や、今後追加予定の機能など"
                                  name="other_message"
                                  class="input-form__input input-form__input--h200px">{{old('other_message',$trApplication->other_message)}}</textarea>
                    </div>
                </div>
                <div class="input-form__item">
                    <div>
                        <span class="badge badge--optional">任意</span><label
                            class="input-form__label">スクリーンショット(2MBまで)</label>
                        <div>
                            <p class="input-form__error-message {{$errors->has('application_upload_image.*') ? 'has-error':'' }}">
                                {{$errors->first('application_upload_image.*')}}</p>
                            <p class="input-form__error-message {{$errors->has('application_upload_image') ? 'has-error':'' }}">
                                {{$errors->first('application_upload_image')}}</p>

                            <div>
                                <p>No.1</p>
                                <div class="upload-image">
                                    @if($trApplication->id && Arr::get($trApplication->applicationThumbnails,1))

                                        <img class="upload-image__item"
                                             src="{{$trApplication->applicationThumbnails[1]}}" class="img-fluid">
                                        <p class="upload-image__check"><input name="image_delete[0]" type="checkbox"
                                                                              value="1"/>削除する
                                        </p>

                                    @endif
                                    {{ Form::file('application_upload_image[1]') }}
                                </div>
                            </div>
                            <div>
                                <p>No.2</p>
                                <div class="upload-image">
                                    @if($trApplication->id && Arr::get($trApplication->applicationThumbnails,2))

                                        <img class="upload-image__item"
                                             src="{{$trApplication->applicationThumbnails[2]}}" class="img-fluid">
                                        <p class="upload-image__check"><input name="image_delete[1]" type="checkbox"
                                                                              value="2"/>削除する
                                        </p>

                                    @endif
                                    {{ Form::file('application_upload_image[2]') }}
                                </div>
                            </div>
                            <div>
                                <p>No.3</p>
                                <div class="upload-image">
                                    @if($trApplication->id && Arr::get($trApplication->applicationThumbnails,3))

                                        <img class="upload-image__item"
                                             src="{{$trApplication->applicationThumbnails[3]}}" class="img-fluid">
                                        <p class="upload-image__check"><input name="image_delete[3]" type="checkbox"
                                                                              value="3"/>削除する
                                        </p>

                                    @endif
                                    {{ Form::file('application_upload_image[3]') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="input-form__submit">
                    <button type="submit" class="button button--default">投稿する</button>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('addFile')

    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="/js/jquery-tagsinput-revisited/jquery.tagsinput-revisited.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="/js/jquery-tagsinput-revisited/jquery.tagsinput-revisited.min.css">

    <script type="text/javascript">
        $('.tagsinput').tagsInput(
            {
                'autocomplete': {
                    delay: 0,
                    source: [
                        'PHP',
                        'MySQL',
                        'Laravel',
                        'iOS',
                        'Swift',
                        'Python',
                        'Android',
                        'SNS',
                        'Ruby',
                        'Vue',
                        'Webサイト',
                        'Java',
                        '便利ツール',
                        '初心者',
                        'Unity',
                        'Wordpress',
                    ],
                    minLength: 0,
                },
            }
        );
        $('.ui-autocomplete-input').on('focus', function () {
            jQuery(this).autocomplete("search", "");
        });

    </script>
@endsection



