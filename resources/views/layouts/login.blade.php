<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/script.js"></script>
</head>
<body>
     <header>
        <div id = "head">
            <h1><a href="/top"></h1>
                <div class="">
                    <img src="{{ asset('images/main_logo.png') }}">
                </a>
                </div>
            <div class="all">
                <div class="ac">
                    <div id="username">
                        <p>{{ $user->username}}さん</p>
                        <p class="arrow">＞</p>
                        <!-- <img class="arrow" src="/storage/images/ダウンロード.png"></img> -->
                    </div>
                    <div class="g-navi">
                        <ul>
                            <li><a href="/top">ホーム</a></li>
                            <li><a href="/profile">プロフィール</a></li>
                            <li><a href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
                </div>
                <div class="img-box icon">
                    <img src="{{ asset('storage/images/'.$user->images) }}">
                </div>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p class="login-name">{{ $user->username}}さんの</p>
                <div class="namber">
                    <p>フォロー数</p>
                    <p>{{ $follow_count }}名</p>
                </div>
                <p class="btn"><a href="/follow-list"><input id="btn-type" type="submit" name="Follow-type1" value="フォローリスト"></a></p>
                <div class="namber">
                    <p>フォロワー数</p>
                    <p>{{ $follower_count }}名</p>
                </div>
                <p class="btn"><a href="/follower-list"><input id="btn-type" type="submit" name="Follow-type2" value="フォロワーリスト"></a></p>
            </div>
            <p class="btn-search"><a href="/search"><input id="btn-type" type="submit" name="Follow-type2" value="ユーザー検索"></a></p>
            <p class="btn-search"><a href="{{route('index')}}">お問合せフォーム</a></p>
            <p class="btn-search"><a href="{{route('history')}}">お問合せ履歴</a></p>
            <p class="btn-search"><a href="{{route('favorite')}}">いいね一覧画面</a></p>
            <p class="btn-search"><a href="{{route('mylist')}}">マイリスト</a></p>
            <p class="btn-search"><a href="{{route('ranking')}}">ランキング</a></p>
            <p class="btn-search"><a href="{{route('ranking_week')}}">週間ランキング</a></p>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>