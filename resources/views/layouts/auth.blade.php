<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", "Beloved-Store")</title>
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    @yield("style")
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
@yield("content")
<script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
@yield("script")
</body>
</html>
