<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index()
    {
        // Fetch all countries
        $response = Http::get('https://restcountries.com/v3.1/all');

        if ($response->failed()) {
            return back()->with('error', 'Failed to fetch country data.');
        }

        $countries = collect($response->json());

        // Extract unique regions for the filter dropdown
        $regions = $countries->pluck('region')->unique()->filter()->values()->toArray();

        // Paginate the results (15 per page)
        $perPage = 100000000;
        $currentPage = request()->input('page', 1);
        $pagedData = $countries->forPage($currentPage, $perPage);

        // Use Laravel’s paginator
        $paginatedCountries = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $countries->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('countries', [
            'countries' => $paginatedCountries,
            'regions' => $regions
        ]);
    }

    public function show($name)
    {
        // Fetch specific country by name
        $response = Http::get("https://restcountries.com/v3.1/name/{$name}");

        if ($response->failed()) {
            return back()->with('error', 'Country details not found.');
        }

        $country = collect($response->json())->first();

        return view('countries.show', ['country' => $country]);
    }
}
