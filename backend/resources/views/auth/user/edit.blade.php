@extends('layout/app')
@section('titleTag', 'ユーザ情報更新')
@section('navCategoryName', 'ユーザ情報')
@section('navPageName', 'ユーザ情報更新')

@section('mainContents')
    <div class="section">
        <h2 class="head-title head-title--section-title">ユーザ情報入力</h2>
        <div class="content">

            <div class="input-form mt-30">
                {{Form::open(['method'=>'post','files' => true,'route' => ['user.store'],'class' => 'input-form__formtag'])}}
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label class="input-form__label">ユーザ名</label>
                    <p class="input-form__error-message {{$errors->first('user_name') ? 'has-error':'' }}">
                        {{$errors->first('user_name')}}</p>
                    <input placeholder="ex)hiro" type="text" name="user_name"
                           class="input-form__input input-form__input--w50per"
                           value="{{old('user_name',$trUser->user_name)}}">
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label class="input-form__label">ユーザプロフィール</label>
                    <p class="input-form__error-message {{$errors->first('user_profile') ? 'has-error':'' }}">
                        {{$errors->first('user_profile')}}</p>
                    <textarea placeholder="ex)自己紹介等"
                              name="user_profile"
                              class="input-form__input input-form__input--h200px">{{old('user_profile',$trUser->id ? $trUser->tr_user_profile->user_profile:'')}}</textarea>
                </div>
                <div class="input-form__item">
                    <span class="badge badge--required">必須</span><label class="input-form__label">スキルセット</label>
                    <p class="input-form__error-message {{$errors->first('user_skillset') ? 'has-error':'' }}">
                        {{$errors->first('user_skillset')}}</p>
                    <textarea placeholder="ex)自分が得意な言語や技術など"
                              name="user_skillset"
                              class="input-form__input input-form__input--h200px">{{old('user_skillset',$trUser->id ? $trUser->tr_user_profile->user_skillset:'')}}</textarea>
                </div>
                <div class="input-form__item">
                    <span class="badge badge--optional">任意</span><label class="input-form__label">Gitアカウント</label>
                    <p class="input-form__error-message {{$errors->first('git_account') ? 'has-error':'' }}">
                        {{$errors->first('git_account')}}</p>
                    <input placeholder="hogehoge" type="text" name="git_account"
                           class="input-form__input input-form__input--w50per"
                           value="{{old('git_account',$trUser->id ? $trUser->tr_user_profile->git_account:'') ?? 'https://github.com/'}}">
                </div>
                <div class="input-form__item">
                    <span class="badge badge--optional">任意</span><label class="input-form__label">ツイッターアカウント</label>
                    <p class="input-form__error-message {{$errors->first('twitter_account') ? 'has-error':'' }}">
                        {{$errors->first('twitter_account')}}</p>
                    <input placeholder="fugafuga" type="text" name="twitter_account"
                           class="input-form__input input-form__input--w50per"
                           value="{{old('twitter_account',$trUser->id ? $trUser->tr_user_profile->twitter_account:'')}}">
                </div>
                <div class="input-form__item">
                    <span class="badge badge--optional">任意</span><label class="input-form__label">個人HP等</label>
                    <p class="input-form__error-message {{$errors->first('my_url') ? 'has-error':'' }}">
                        {{$errors->first('my_url')}}</p>
                    <input placeholder="https://example.com" type="text" name="my_url"
                           class="input-form__input input-form__input--w50per"
                           value="{{old('my_url',$trUser->id ? $trUser->tr_user_profile->my_url:'')}}">
                </div>


                <div class="input-form__item">
                    <span class="badge badge--optional">任意</span><label class="input-form__label">プロフィールアイコン</label>
                    <div>
                        <p class="input-form__error-message {{$errors->has('profile_upload_image') ? 'has-error':'' }}">
                            {{$errors->first('profile_upload_image')}}</p>
                    </div>
                    <div class="upload-image">
                        @if($trUser->id && $trUser->profileImage)

                            <img class="upload-image__item"
                                 src="{{$trUser->profileImage}}" class="img-fluid">
                            <p class="upload-image__check"><input name="delete_image" type="checkbox"
                                                                  value="1"/>削除する
                            </p>

                        @endif
                        {{ Form::file('profile_upload_image') }}
                    </div>
                </div>


                <div class="input-form__submit">
                    <button type="submit" class="button button--default">登録する</button>
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



