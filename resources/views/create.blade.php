<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Multiple Items</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">Home</a>
    </nav>
    <div class="container pt-5">
        <h2 class="text-center pb-3 text-primary">Add Multiple Items</h2>

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="input-fields-container">
                <div class="input-group mb-3 item-row">
                    <input type="text" class="form-control" name="inputs[0][name]" placeholder="Name" required>
                    <input type="text" class="form-control" name="inputs[0][description]" placeholder="Description"
                        required>
                    <input type="file" class="form-control" name="inputs[0][image]" accept="image/*">
                    <input type="number" class="form-control" name="inputs[0][quantity]" placeholder="Quantity"
                        min="0">
                    <button type="button" class="btn btn-danger remove-item-row">Remove</button>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="add-item-row">Add Another Item</button>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('add-item-row').addEventListener('click', function() {
            const container = document.getElementById('input-fields-container');
            const rows = container.getElementsByClassName('item-row');

            if (rows.length >= 10) { // Prevent adding more than 10 rows
                alert('Maximum of 10 rows allowed.');
                return;
            }

            const index = rows.length;
            const row = document.createElement('div');
            row.className = 'input-group mb-3 item-row';
            row.innerHTML = `
        <input type="text" class="form-control" name="inputs[${index}][name]" placeholder="Name" required>
        <input type="text" class="form-control" name="inputs[${index}][description]" placeholder="Description" required>
        <input type="file" class="form-control" name="inputs[${index}][image]" accept="image/*">
        <input type="number" class="form-control" name="inputs[${index}][quantity]" placeholder="Quantity" min="0">
        <button type="button" class="btn btn-danger remove-item-row">Remove</button>
    `;
            container.appendChild(row);
        });

        document.getElementById('input-fields-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item-row')) {
                e.target.closest('.item-row').remove();
            }
        });
    </script>
</body>

</html>
