<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Item Details</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container pt-5">
        <h2 class="text-center pb-3 text-primary">Item Details</h2>

        <div class="card">
            <div class="card-header">
                <h3>{{ $item->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Description:</strong> {{ $item->description }}</p>
                <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                @if ($item->image)
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}"
                        style="width: 200px;">
                @endif
            </div>
        </div>

        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mt-3">Delete</button>
        </form>

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Back</a>
    </div>
</body>

</html>
