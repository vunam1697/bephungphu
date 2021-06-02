<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404</title>
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/slick.min.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/slick-theme.min.css">
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/jquery.mmenu.all.css"> 
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/style.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/responsive.css">

    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
    <header></header>
    <main>
        <section id="error">
            <div class="container">
                <div class="content text-center">
                    <div class="logo-err"><a title="" href="{{ url('/') }}"><img src="{{ __BASE_URL__ }}/images/err.png" class="img-fluid" alt=""></a></div>
                    <div class="avar"><img src="{{ __BASE_URL__ }}/images/404.png" class="img-fluid" alt=""></div>
                    <h1>Không tìm thấy trang</h1>
                    <p>Trang đã bị xóa hoặc địa chỉ URL không đúng</p>
                    <div class="gohome"><a title="" href="{{ url('/') }}">Quay về trang chủ</a></div>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>

<!--Link js-->
<script type="text/javascript" src="{{ __BASE_URL__ }}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ __BASE_URL__ }}/js/slick.min.js"></script>
<script type="text/javascript" src="{{ __BASE_URL__ }}/js/jquery.mmenu.all.js"></script>
<script type="text/javascript" src="{{ __BASE_URL__ }}/js/private.js"></script>
</body>
</html>
