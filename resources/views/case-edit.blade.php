<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KCSS CMS - Edit Case</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        /* Add other styles as needed */
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Case</h1>
        <form method="POST" action="{{ route('case.update', $case->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="caseTitle" class="form-label">Case Title</label>
                <input type="text" class="form-control" id="caseTitle" name="title" value="{{ $case->title }}" required>
            </div>
            <div class="mb-3">
                <label for="client_id" class="form-label">Client</label>
                <select class="form-select" id="client_id" name="client_id" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $case->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->name }} - {{ $client->nationalid }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="caseStatus" class="form-label">Status</label>
                <select class="form-select" id="caseStatus" name="status" required>
                    <option value="Open" {{ $case->status == 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="Closed" {{ $case->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $case->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Case</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>