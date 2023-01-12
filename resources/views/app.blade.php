<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>How To</title>
</head>
<body>
<div id="app"></div>
<script>window.Laravel = { csrfToken: '{{ csrf_token() }}', user: @json($user) }</script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>