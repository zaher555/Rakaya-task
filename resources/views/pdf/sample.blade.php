<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
</head>
<body>
    <h1>Books List</h1>
    <ul>
        @foreach ($books as $book)
            <li>{{ $book->title }} by {{ $book->authour }}</li>
        @endforeach
    </ul>
</body>
</html>
