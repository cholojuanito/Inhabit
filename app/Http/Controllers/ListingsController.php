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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('listing.create')->with(['user' => $user, 'states' => config('app.states')]);
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
