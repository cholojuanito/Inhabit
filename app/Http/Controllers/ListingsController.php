<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Listing;
use App\Http\Requests\CreateListingRequest;

class ListingsController extends Controller
{

    /**
     * Create a new ListingsController instance.
     */
    public function _construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gets all the listings and paginates them
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $listings = Listing::paginate(50);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Got all the listings',
                'data' => $listings
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateListingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'street_address' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required',
            'zip_code' => 'required',
            'apt_num' => 'sometimes|string|nullable',
            'date_available' => 'required|date',
            'rental_type' => 'required',
            'monthly_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'num_beds' => 'required|between:0.0,20.0',
            'num_baths' => 'required|between:0.0,20.0',
            'square_ft' => 'required|numeric|min:0'
        ]);

        $listing = Listing::create([
            'user_id' => auth()->id(),
            'street_address' => request('street_address'),
            'city' => request('city'),
            'state' => request('state'),
            'zip_code' => request('zip_code'),
            'lng' => request('lng'),
            'lat' => request('lat'),
            'apt_num' => request('apt_num'),
            'date_available' => request('date_available'),
            'rental_type' => request('rental_type'),
            'monthly_price' => request('monthly_price'),
            'description' => request('description'),
            'num_beds' => request('num_beds'),
            'num_baths' => request('num_baths'),
            'square_ft' => request('square_ft')
        ]);

        $user = Auth::user();

        return response(
            [
                'status' => 'success',
                'message' => 'Listing was created!',
                'data' => $listing
            ],
            200
        );
    }

    /**
     * Get the listings the current user is selling
     * 
     */
    public function getUserListings(Request $request)
    {
        $listings = Auth::user()->listings()->get();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Got user\'s listings',
                'data' => $listings
            ],
            200
        );
    }

    /**
     * Get the listings the current user has as favorites
     * 
     */
    public function getUserFavorites(Request $request)
    {
        $listings = Auth::user()->favorites()->get();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Got the favorites',
                'data' => $listings
            ],
            200
        );
    }

    /**
     * Change whether a listing is favorited or not
     * 
     */
    public function favorite(Request $request)
    {
        try {
            Auth::user()->favorites()->syncWithoutDetaching(request('listing_id'));
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Unable to favorite the listing'
                ],
                500
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Favorited the listing!'
            ],
            200
        );
    }

    /**
     * Change whether a listing is favorited or not
     * 
     */
    public function unfavorite(Request $request)
    {
        try {
            Auth::user()->favorites()->detach(request('listing_id'));
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Unable to favorite the listing'
                ],
                500
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Unfavorited the listing!'
            ],
            200
        );
    }

    /**
     * Get the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return Listing::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        return view('listing.edit')->with(['listing' => $listing]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'street_address' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required',
            'zip_code' => 'required',
            'apt_num' => 'sometimes|string|nullable',
            'date_available' => 'required|date',
            'monthly_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'num_beds' => 'required|between:0.0,20.0',
            'num_baths' => 'required|between:0.0,20.0',
            'square_ft' => 'required|numeric|min:0'
        ]);

        $listing = Listing::findOrFail($id);
        $listing->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);

        $listing->delete();
    }

}
