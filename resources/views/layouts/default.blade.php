<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", "Beloved-Store")</title>
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/beloved-store.png')}}">
    @yield("style")
</head>
<body>
@include("includes.header")
@yield("content")
@include("includes.footer")
@include("includes.bottom")
<script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
@yield("script")
</body>
</html>
