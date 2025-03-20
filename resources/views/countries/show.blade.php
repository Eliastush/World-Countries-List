<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $country['name']['common'] ?? 'Country Details' }}  ||  Details</title>
    
    <!-- Favicon (Flag) -->
    <link rel="icon" href="{{ $country['flags']['png'] ?? '#' }}" type="image/png">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Full-screen background with country flag */
        body {
            background: url("{{ $country['flags']['png'] ?? '#' }}") center/cover no-repeat;
            font-family: 'Inter', sans-serif;
            color: #222; /* Darker text for better visibility */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* ID-style card */
        .country-card {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.95); /* More opaque background */
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            color: #333; /* Ensures text remains readable */
        }

        /* Country name heading */
        .country-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Flag */
        .flag {
            width: 100px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        /* Two-column layout */
        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 15px;
            padding: 6px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Single row */
        .info-single {
            font-size: 15px;
            padding: 6px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Remove border from last row */
        .info-single:last-child,
        .info-row:last-child {
            border-bottom: none;
        }

        /* Back button */
        .back-btn {
            margin-top: 15px;
        }

        /* Footer */
        .footer {
            font-size: 12px;
            color: #555;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="country-card">
    <!-- Country Name -->
    <div class="country-name">
        {{ $country['name']['common'] ?? 'Unknown Country' }}
    </div>

    <!-- Flag -->
    <img src="{{ $country['flags']['png'] ?? '#' }}" class="flag" alt="Flag">

    <!-- Country Details -->
    <div class="info-single"><strong>Region:</strong> {{ $country['region'] ?? 'N/A' }}</div>
    <div class="info-single"><strong>Subregion:</strong> {{ $country['subregion'] ?? 'N/A' }}</div>

    <div class="info-row">
        <div><strong>Population:</strong> {{ number_format($country['population'] ?? 0) }}</div>
        <div><strong>Time Zone:</strong> {{ implode(', ', $country['timezones'] ?? ['N/A']) }}</div>
    </div>

    <div class="info-row">
        <div><strong>Calling Code:</strong> {{ $country['idd']['root'] ?? '' }}{{ $country['idd']['suffixes'][0] ?? '' }}</div>
        <div><strong>Native Name:</strong> 
            {{ $country['name']['nativeName'][array_key_first($country['name']['nativeName'])]['official'] ?? 'N/A' }}
        </div>
    </div>

    <div class="info-single"><strong>Languages:</strong> 
        @if (isset($country['languages']))
            {{ implode(', ', $country['languages']) }}
        @else
            N/A
        @endif
    </div>

    <div class="info-single"><strong>Currency:</strong> 
        @if (isset($country['currencies']))
            @foreach ($country['currencies'] as $currency)
                {{ $currency['name'] ?? 'N/A' }} ({{ $currency['symbol'] ?? '' }})
            @endforeach
        @else
            N/A
        @endif
    </div>

    <div class="info-row">
        <div><strong>Start of the Week:</strong> {{ $country['startOfWeek'] ?? 'N/A' }}</div>
        <div><strong>Postal Code:</strong> {{ $country['postalCode']['format'] ?? 'N/A' }}</div>
    </div>

    <!-- Back Button -->
    <div class="back-btn">
        <a href="{{ url('/') }}" class="btn btn-dark btn-sm">🔙 Back</a>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Developed by <strong>Elias Mutugi</strong> | Contact: 0720633477 | Email: mutugielias01@gmail.com</p>
    </div>
</div>

</body>
</html>
