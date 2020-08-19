@extends('layout/app')
@section('titleTag',$trApplication->application_name.' | '.'フィードバック募集一覧')

@section('navCategoryName', $trApplication->application_name)
@section('navPageName', 'フィードバック募集')

@section('mainContents')

    <section class="section">
        <h2 class="head-title head-title--section-title">募集一覧</h2>
        <div class="content mt-10">
            <div class="col-pc-2-mobile-1">
                @forelse($feedbacks as $feedback)
                    <div class="col-pc-2-mobile-1__cel">
                        <div class="feedback">
                            <div class="feedback--title">
                                {{$feedback->feedback_title}}
                            </div>
                            <div class="feedback--footer">
                                <div class="button--feedback">
                                    <a href="{{route('feedback.show',$feedback)}}">
                                        <button class="button button--default">詳細
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="mt-15 u-empty-content">まだフィードバック募集がありません
                    </div>
                @endforelse
            </div>
        </div>

    </section>



@endsection
