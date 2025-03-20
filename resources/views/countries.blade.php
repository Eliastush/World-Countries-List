<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORLD COUNTRIES LIST</title>

    <!-- Bootstrap & jQuery -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Theme Colors */
        :root {
            --maroon-light: #800000;
            --maroon-dark: #4a0000;
            --maroon-soft: #b22222;
            --white: #ffffff;
            --gray-light: #f8f9fa;
            --gray-dark: #343a40;
        }

        /* General Styling */
        body {
            background-color: var(--gray-light);
            color: var(--maroon-dark);
        }

        /* Header */
        .header {
            background-color: var(--maroon-light);
            color: var(--white);
            padding: 10px;
            border-radius: 8px;
        }

        .header h2 {
            font-weight: bold;
        }

        .header input, .header select, .header button {
            border: none;
            padding: 8px;
            border-radius: 5px;
        }

        .header input, .header select {
            background-color: var(--white);
            color: var(--maroon-dark);
        }

        .header button {
            background-color: var(--maroon-dark);
            color: var(--white);
        }

        /* Table Styling */
        .table-container {
            max-height: 500px;
            overflow-y: auto;
            position: relative;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            background-color: var(--maroon-dark);
            color: var(--white);
            position: sticky;
            top: 0;
            z-index: 10;
            padding: 10px;
        }

        .table td {
            border-bottom: 1px solid var(--maroon-soft);
            padding: 10px;
        }

        .table tbody tr:hover {
            background-color: rgba(128, 0, 0, 0.274)9);
        }
        tr:hover{
            background-color: rgba(128, 0, 0, 0.274)9);
        }
        /* Dark Mode */
        .dark-mode {
            background-color: black;
            color: white;
        }

        .dark-mode .header {
            background-color: black;
        }

        .dark-mode .table th {
            background-color: black;
        }

        .dark-mode .table td {
            border-bottom: 1px solid white;
        }

        .dark-mode .header input, 
        .dark-mode .header select {
            background-color: black;
            color: white;
            border: 1px solid white;
        }

        .dark-mode .header button {
            background-color: white;
            color: black;
        }

        /* Footer */
        .footer {
            background-color: var(--maroon-light);
            color: var(--white);
            padding: 15px;
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }

        .footer .info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer .contact {
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
        <h2>🌍 WORLD COUNTRIES LIST</h2>
        <div class="d-flex">
            <input type="text" id="search" class="form-control me-2" placeholder="🔍 Search...">
            <select id="regionFilter" class="form-control">
                <option value="">🌎 Filter by Region</option>
                @foreach($regions as $region)
                    <option value="{{ $region }}">{{ $region }}</option>
                @endforeach
            </select>
        </div>
        <h2 id="" class="btn">ELIAS MUTUGI</h2>
    </div>

    <!-- Top Counts -->
    <div class="d-flex justify-content-between my-3">
        <p><strong>Total Countries:</strong> <span id="topTotalCount">{{ count($countries) }}</span></p>
        <p><strong>Total Population:</strong> <span id="topTotalPopulation">0</span></p>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Flag</th>
                    <th>Name</th>
                    <th>Capital</th>
                    <th>Population</th>
                    <th>Region</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="countryTable">
                @foreach ($countries as $country)
                <tr onclick="window.location.href='{{ url('/country/' . $country['name']['common']) }}'">
                    <td><img src="{{ $country['flags']['png'] }}" width="40"></td>
                    <td>{{ $country['name']['common'] }}</td>
                    <td>{{ $country['capital'][0] ?? 'N/A' }}</td>
                    <td>{{ number_format($country['population']) }}</td>
                    <td>{{ $country['region'] }}</td>
                    <td><a href="{{ url('/country/' . $country['name']['common']) }}" class="btn btn-sm btn-primary">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="info">
            <p><strong>Total Countries:</strong> <span id="bottomTotalCount">{{ count($countries) }}</span></p>
            <p><strong>Total Population:</strong> <span id="bottomTotalPopulation">0</span></p>
            <p class="contact"><strong>Elias Mutugi</strong> | 📞 0720633477 | ✉️ mutugielias01@gmail.com</p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function updateCounts() {
            var totalPopulation = 0;
            $("#countryTable tr:visible").each(function() {
                var pop = parseInt($(this).find("td:nth-child(4)").text().replace(/,/g, '')) || 0;
                totalPopulation += pop;
            });

            $("#topTotalPopulation, #bottomTotalPopulation").text(totalPopulation.toLocaleString());
            $("#topTotalCount, #bottomTotalCount").text($("#countryTable tr:visible").length);
        }

        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#countryTable tr").each(function() {
                $(this).toggle($(this).text().toLowerCase().includes(value));
            });
            updateCounts();
        });

        $("#regionFilter").on("change", function() {
            var selected = $(this).val().toLowerCase();
            $("#countryTable tr").each(function() {
                $(this).toggle(selected === "" || $(this).find("td:nth-child(5)").text().toLowerCase() === selected);
            });
            updateCounts();
        });

        $("#darkModeToggle").click(() => $("body").toggleClass("dark-mode"));
        updateCounts();
    });
</script>

</body>
</html>
