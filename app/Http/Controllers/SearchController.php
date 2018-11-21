<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query;
        $numericFilters = [];
        $facetFilters = [];

        if ($request->has('q')) {
            if ($request->has('numFilters')) {
                $numericFilters = request('numFilters');
            }
            if ($request->has('facetFilters')) {
                $facetFilters = request('facetFilters');
            }
            $query = request('q');

            try {
                // Add the filters to the search so they are applied
                $listings = Listing::search($query, function ($algoliaIdx, $q, $searchParams) use ($numericFilters, $facetFilters) {
                    $searchParams['numericFilters'] = $numericFilters;
                    $searchParams['facetFilters'] = $facetFilters;

                    return $algoliaIdx->search($q, $searchParams);
                })->paginate(10);
            } catch (\AlgoliaSearch\AlgoliaException $e) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Issue occured while searching'
                    ],
                    500
                );
            }
            return response()->json(
                [
                    'data' => $listings
                ],
                200
            );


        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'No keywords were given'
                ],
                400
            );
        }
    }
}
