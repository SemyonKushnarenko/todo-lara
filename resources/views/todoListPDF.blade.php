<!DOCTYPE html>
<html>
<head>
    <title>TodoList {{ $id }}, {{ $user->name }}, {{ $user->email }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $description }}</p>
    <hr>
<ul>
    @foreach($todos as $todo)
        <li style="@if($todo->is_done)text-decoration:line-through;@endif">{{ $todo->title }}</li>
    @endforeach
</ul>

</body>
</html>