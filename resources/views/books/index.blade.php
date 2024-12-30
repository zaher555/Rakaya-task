<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
  @if(empty($books) || $books->isEmpty())
    <p>No books found matching your search.</p>
  @endif
    @if($books)
    <div class="container-fluid p-5">
      @if(session('message'))
        <div class="alert alert-success" id="success-message">
          {{ session('message') }}
        </div>
      @endif
        <h1 class="text-center">Books Club</h1>
        <div class="d-flex justify-content-space-between align-items-center pb-2">
          <div class="w-75">
            <a class="btn btn-dark text-warning" href="/books/create">+ New Book</a>
          </div>
          <div class="input-group w-25">
            <form action="{{ route('books.search') }}" method="GET" class="d-flex">
              <input type="text" class="form-control" name="search">
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
          </div>
        </div>
        <table class="table border table-striped-columns table-hover">
            <thead>
              <tr class="text-center">
                <th class="bg-dark text-warning">No.</th>
                <th class="bg-dark text-warning">Title</th>
                <th class="bg-dark text-warning">Author</th>
                <th class="bg-dark text-warning">Availability</th>
                <th class="bg-dark text-warning">Actions</th>
              </tr>
            </thead>
            <tbody>
             @for ($i=0;$i<count($books);$i++)
             <tr>
                <th>{{ $i+1 }}</th>
                <td>{{ $books[$i]->title }}</td>
                <td>{{ $books[$i]->authour }}</td>
                <td>{{ $books[$i]->availability_status ? 'Available' : 'Not Available' }}</td>
                <td class="d-flex justify-content-evenly">
                    <a href="/books/{{ $books[$i]->id }}">View</a>
                    <a href="/books/{{ $books[$i]->id }}/edit">Edit</a>
                    <form action="/books/{{ $books[$i]->id }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="border-0" style="background-color: transparent">
                        <a class="link-opacity-100">Delete</a>
                      </button>
                    </form>
                </td>
              </tr>
             @endfor
            </tbody>
        </table>
        <a href="generate-pdf" class="text-dark" style="font-size: 2rem"><i class="fa-solid fa-file-pdf"></i></a>
        @if($count>=10)
        {{ $books->links() }}
        @endif
    </div>
    @endif
    <script>
        setTimeout(function() {
          var message = document.getElementById('success-message');
          if (message) {
            message.style.display = 'none';
          }
        }, 2000);  // 2000 milliseconds = 2 seconds
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>