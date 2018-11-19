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
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $listings = Listing::all(); //Eventually paginate these

        return view('browse')->with([
            'user' => $user,
            'listings' => $listings,
        ]);
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
            'address' => 'required|string|max:255',
            'apt_num' => 'sometimes|string|nullable',
            'date_available' => 'required|date',
            'monthly_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'num_beds' => 'required|between:0.0,20.0',
            'num_baths' => 'required|between:0.0,20.0',
            'square_ft' => 'required|numeric|min:0'
        ]);

        $listing = Listing::create([
            'user_id' => auth()->id(),
            'address' => request('street_address'),
            'apt_num' => request('apt_num'),
            'date_available' => request('date_available'),
            'monthly_price' => request('monthly_price'),
            'description' => request('description'),
            // 'contact_name'      => request('contact_name'),
            // 'contact_phone'     => request('contact_phone'),
            // 'contact_email'     => request('contact_email'),
            'num_beds' => request('num_beds'),
            'num_baths' => request('num_baths'),
            'square_ft' => request('square_ft')
        ]);

        $user = Auth::user();

        return redirect('/user/' . $user->id . '/listings');
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
            'address' => 'required|string|max:255',
            'apt_num' => 'sometimes|string|nullable',
            'date_available' => 'required|date',
            'monthly_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            // 'contact_name'      => 'required|string|max:255',
            // 'contact_phone'     => 'required|phone:US',
            // 'contact_email'     => 'required|email|max:255',
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
