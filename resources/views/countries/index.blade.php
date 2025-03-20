<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌍 Countries List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body.dark-mode { background-color: #121212; color: white; }
        .dark-mode .table { background-color: #1e1e1e; color: white; }
        .dark-mode .table thead { background-color: #333; }
        .dark-mode .form-control, .dark-mode .btn { background-color: #333; color: white; border: 1px solid white; }
        .dark-mode a { color: #ffc107; }
        .pagination { display: flex; justify-content: center; padding: 10px; list-style: none; }
        .pagination li a, .pagination li span { padding: 8px 12px; border-radius: 5px; border: 1px solid #007bff; color: #007bff; text-decoration: none; }
        .pagination .active span { background-color: #007bff; color: white; border: none; }
        .pagination li a:hover { background-color: #007bff; color: white; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🌍 List of Countries <i style="color: #007bff"> <strong id="totalCount">{{ $totalCount }}</strong> </i></h2>
        <button id="darkModeToggle" class="btn btn-dark">Toggle Dark Mode</button>
    </div>

    <!-- Search & Filter -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="Search for a country..." value="{{ $search }}">
        </div>
        <div class="col-md-4">
            <select id="regionFilter" class="form-control">
                <option value="">Filter by Region</option>
                @foreach($regions as $region)
                    <option value="{{ $region }}" {{ $region == $regionFilter ? 'selected' : '' }}>{{ $region }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Countries Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Flag</th>
                    <th>Name</th>
                    <th>Capital</th>
                    <th>Population</th>
                    <th>Region</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                <tr>
                    <td><img src="{{ $country['flags']['png'] }}" width="40"></td>
                    <td>{{ $country['name']['common'] }}</td>
                    <td>{{ $country['capital'][0] ?? 'N/A' }}</td>
                    <td>{{ number_format($country['population']) }}</td>
                    <td>{{ $country['region'] }}</td>
                    <td>
                        <a href="{{ url('/country/' . $country['name']['common']) }}" class="btn btn-primary btn-sm">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $countries->links() }}
    </div>

    <!-- Total Count -->
    <div class="mt-3">
        <h5>Total Population: <span id="totalPopulation">{{ number_format($totalPopulation) }}</span></h5>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#search, #regionFilter").on("input change", function() {
            let search = $("#search").val();
            let region = $("#regionFilter").val();
            window.location.href = `?search=${search}&region=${region}`;
        });

        $("#darkModeToggle").click(function() {
            $("body").toggleClass("dark-mode");
            localStorage.setItem("darkMode", $("body").hasClass("dark-mode"));
        });

        if (localStorage.getItem("darkMode") === "true") {
            $("body").addClass("dark-mode");
        }
    });
</script>

</body>
</html>
