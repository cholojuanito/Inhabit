<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Upload;
use Image;

class UploadsController extends Controller
{
    /**
     * Get all uploads for the listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        //
    }

    /**
     * Store the upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,svg|max:10000'
        ]);

        $uploads = [];
        $user = Auth::user();
        $listingID = $request->input('listing_id');
        $requestFiles = $request->files;
        $fileNum = 0; // Will only be 0 or 1 since the files come chunked
        foreach ($requestFiles as $files) {
            foreach ($files as $file) {
                $filePath = $user->id . time() . $fileNum . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save(public_path('uploads\\listings\\' . $filePath)); // Change the back slashes for unix machines

                $upload = Upload::forceCreate([
                    'listing_id' => $listingID,
                    'file_path' => $filePath
                ]);
                $uploads[] = $upload;
                $fileNum++;
            }
        }
        return $uploads;
    }

    /**
     * Display the upload resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *   public function show($id)
     *  {
     *       //
     *   }
     */

    /**
     * Remove the upload from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ['success' => true];
    }
}
