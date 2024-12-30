<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container border p-5">
        <form action="/books" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            @error('title')
                <p class="text-danger">* {{ $message }}</p>
            @enderror
            <div class="mb-3">
                <label for="authour" class="form-label">Authour</label>
                <input type="text" class="form-control" id="authour" name="authour">
            </div>
            @error('authour')
                <p class="text-danger">* {{ $message }}</p>
            @enderror
            <div class="mb-3">
                <select class="form-select" name="availability_status">
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <button class="btn btn-success">Add</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>