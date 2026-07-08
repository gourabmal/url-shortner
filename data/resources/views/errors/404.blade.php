@php
    $siteInfo = \App\Helper\admin\siteInformation::siteInfo();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>
    <link rel="icon" href="{{$siteInfo['favicon']}}" type="image/gif" sizes="16x16">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/errors/404.css" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="robots" content="noindex, follow">
</head>
<body>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
            <h2>Page not found</h2>
        </div>
        <a href="{{url()->previous()}}">Homepage</a>
    </div>
</div>
</body>
</html>
