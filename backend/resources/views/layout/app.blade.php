<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{env('GOOGLE_ANALYTICS_TRACKING_ID')}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '{{env('GOOGLE_ANALYTICS_TRACKING_ID')}}');
    </script>


    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('titleTag') | 個人.dev</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">
@section('twitterCard')

@show

<!-- Favicons -->
    <link href="/img/favicon.png" rel="icon">
    <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="/css/block/page.css" rel="stylesheet">
    <link href="/css/block/section.css" rel="stylesheet">
    <link href="/css/block/first-view.css" rel="stylesheet">
    <link href="/css/block/button.css" rel="stylesheet">
    <link href="/css/block/header.css" rel="stylesheet">
    <link href="/css/block/application-card.css" rel="stylesheet">
    <link href="/css/block/head-title.css" rel="stylesheet">
    <link href="/css/block/col.css" rel="stylesheet">
    <link href="/css/block/icon.css" rel="stylesheet">
    <link href="/css/block/badge.css" rel="stylesheet">
    <link href="/css/block/breadcrumbs.css" rel="stylesheet">
    <link href="/css/block/gallary.css" rel="stylesheet">
    <link href="/css/block/application-spec.css" rel="stylesheet">
    <link href="/css/block/develop-report.css" rel="stylesheet">
    <link href="/css/block/footer.css" rel="stylesheet">
    <link href="/css/block/tags-list.css" rel="stylesheet">
    <link href="/css/block/section-head.css" rel="stylesheet">
    <link href="/css/block/content.css" rel="stylesheet">
    <link href="/css/block/icon-font.css" rel="stylesheet">
    <link href="/css/block/user-post.css" rel="stylesheet">
    <link href="/css/block/user-icon.css" rel="stylesheet">
    <link href="/css/block/profile.css" rel="stylesheet">
    <link href="/css/block/social-icon-list.css" rel="stylesheet">
    <link href="/css/block/application-detail-card.css" rel="stylesheet">
    <link href="/css/block/section-head.css" rel="stylesheet">
    <link href="/css/block/upload-image.css" rel="stylesheet">
    <link href="/css/block/input-form.css" rel="stylesheet">
    <link href="/css/block/admin-action.css" rel="stylesheet">
    <link href="/css/block/modal-confirm.css" rel="stylesheet">
    <link href="/css/block/pagination.css" rel="stylesheet">
    <link href="/css/block/user-card.css" rel="stylesheet">
    <link href="/css/block/line-form.css" rel="stylesheet">
    <link href="/css/block/feedback.css" rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">


    <link href="/css/utility.css" rel="stylesheet">


</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header">

    <h1 class="header__logo"><a href="/">個人.dev</a></h1>

    <nav class="header__right">
        <ul class="header__ling-group">
            <li class="header__link"><a href="/">トップ</a></li>
            <li class="header__link"><a href="{{route('user.me')}}">マイページ</a></li>
        </ul>
    </nav>

</header>


<main>
    @section('navContents')
        <section class="section section--backcolor-dark">
            <div class="content">
                <ol class="breadcrumbs__list">
                    <li class="breadcrumbs__link"><a href="/">TOP</a></li>
                    <li class="breadcrumbs__link">@yield('navCategoryName')</li>
                </ol>
                <h2 class="breadcrumbs__now">@yield('navPageName')</h2>
            </div>
        </section>
    @show
    @yield('mainContents')
</main>

<!-- ======= Footer ======= -->
<footer class="footer">
    <h3 class="footer__logo">KOJIN</h3>
    <div class="footer__email">
        <div>
            <a href="{{route('logout')}}">ログアウト</a>|<a href="{{route('userpolicy')}}">利用規約</a>
        </div>
        <strong>Email:</strong> {{env('APP_EMAIL')}}<br>
    </div>
    <p class="footer__copyright">
        &copy; Copyright <strong><span>hiroyuki-w</span></strong>. All Rights Reserved
    </p>
</footer><!-- End Footer -->


<!-- Vendor JS Files -->
<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
<script src="/js/app.js"></script>
@section('addFile')

@show


</body>

</html>
