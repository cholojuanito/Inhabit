<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = '';
        $numericFilters = [];
        $facetFilters = [];
        $radius = 85000;  // Value is in meters. It defaults to about 50 miles
        $lat = null;
        $lng = null;

        if ($request->has('query')) {
            if ($request->has('numFilters')) {
                $numericFilters = request('numFilters');
            }
            if ($request->has('facetFilters')) {
                $facetFilters = request('facetFilters');
            }
            if ($request->has('location')) {
                $lat = request('lat');
                $lng = request('lng');
            }
            $query = request('query');

            try {
                // Add the filters to the search so they are applied
                $listings = Listing::search($query, function ($algoliaIdx, $q, $searchParams) use ($lat, $lng, $radius, $numericFilters, $facetFilters) {

                    $searchParams['numericFilters'] = $numericFilters;
                    $searchParams['facetFilters'] = $facetFilters;

                    // Search by latitude and longitude
                    if ($lat !== null && $lng !== null) {
                        $location = [
                            'aroundLatLng' => (float)$lat . ',' . (float)$lng,
                            'aroundRadius' => $radius,
                        ];
                        $searchParams = array_merge($searchParams, $location);
                    }

                    return $algoliaIdx->search($q, $searchParams);
                })->paginate(50);
            } catch (\AlgoliaSearch\AlgoliaException $e) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Issue occured while searching'
                    ],
                    500
                );
            } catch (Exception $e) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Issue occured in general'
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
