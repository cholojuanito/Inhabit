<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('profile')->with(['user' => User::findOrFail($id)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ],
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.edit')->with(['user' => User::findOrFail($id)]);
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
        $user = User::findOrFail($id);

        // if ($user->confirmed !== true) {
        //     return some flash notification
        // }

        $queryArray = $request->all();
        $fileName = 'default.png';

        if ($request->hasFile('profile_pic')) {
            $profilePic = $request->file('profile_pic');
            $fileName = time() . '.' . $profilePic->getClientOriginalExtension();
            Image::make($profilePic)->resize(300, 300)->save(public_path('uploads\\avatars\\' . $fileName)); // Change the back slashes for unix machines
        }

        $queryArray['profile_pic'] = $fileName;

        $user->update($queryArray);

        return view('user.edit')->with(['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the listings associated with the user.
     * 
     * @param int $id
     * @return View
     */
    public function showUserListings($id)
    {
        $user = User::findOrFail($id);

        $listings = $user->listings()->get();

        return view('user.listings')->with([
            'listings' => $listings,
            'user' => $user
        ]);
    }


}
