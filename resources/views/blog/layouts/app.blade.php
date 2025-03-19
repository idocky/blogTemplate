<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/project.config.css') }}" />
    @vite(['resources/js/app.js'])
</head>
<body>
<div id="vue-app">
    <header-component></header-component>
    @yield('content')
    <footer-component></footer-component>
</div>
</body>
</html>





