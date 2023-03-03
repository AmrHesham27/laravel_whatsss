<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content='{{ $description }}'>
    <title>{{ $title }}</title>
    
    <link href="{{ asset('assets/css/store.css')}}" rel="stylesheet" />

    {{ vite_assets() }}
</head>
<body>
    <div id="root" data='{{ $store }}'></div>
</body>
</html>