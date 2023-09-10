<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');
        $bedrooms = $request->input('bedrooms');
        $bathrooms = $request->input('bathrooms');
        $storeys = $request->input('storeys');
        $garages = $request->input('garages');
        $price = $request->input('priceRange');

        $query = Listing::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($bedrooms) {
            $query->where('bedrooms', $bedrooms);
        }

        if ($bathrooms) {
            $query->where('bathrooms', $bathrooms);
        }

        if ($storeys) {
            $query->where('storeys', $storeys);
        }

        if ($garages) {
            $query->where('garages', $garages);
        }

        if (!empty($price) && count($price) === 2) {
            $minPrice = $price[0];
            $maxPrice = $price[1];
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        $results = $query->get();

        return response()->json($results);
    }
}
