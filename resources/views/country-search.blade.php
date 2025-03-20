<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">🌍 Search Country Details</h2>

    <form method="POST" action="/country">
        @csrf
        <div class="mb-3">
            <input type="text" name="country" class="form-control" placeholder="Enter country name" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    @if(isset($countryData))
    <div class="card mt-4">
        <div class="card-header">
            <h4>{{ $countryData['name']['common'] }} ({{ $countryData['cca2'] }})</h4>
        </div>
        <div class="card-body">
            <p><strong>Official Name:</strong> {{ $countryData['name']['official'] }}</p>
            <p><strong>Capital:</strong> {{ $countryData['capital'][0] ?? 'N/A' }}</p>
            <p><strong>Population:</strong> {{ number_format($countryData['population']) }}</p>
            <p><strong>Currency:</strong> 
                @foreach($countryData['currencies'] as $currency)
                    {{ $currency['name'] }} ({{ $currency['symbol'] ?? '' }})
                @endforeach
            </p>
            <p><strong>Region:</strong> {{ $countryData['region'] }}</p>
            <p><strong>Subregion:</strong> {{ $countryData['subregion'] ?? 'N/A' }}</p>
            <p><strong>Languages:</strong> 
                @foreach($countryData['languages'] as $language)
                    {{ $language }},
                @endforeach
            </p>
            <p><strong>Timezones:</strong> {{ implode(', ', $countryData['timezones']) }}</p>
            <p><strong>Flag:</strong> 🇨🇦</p>
            <img src="{{ $countryData['flags']['png'] }}" alt="Flag" width="100">
        </div>
    </div>
    @endif

</body>
</html>
