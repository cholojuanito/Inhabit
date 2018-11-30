<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Upload;
use App\Listing;
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

        // The files come in chunked so we need the double for loop to iterate them all
        foreach ($requestFiles as $files) {
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $path = hash('sha256', time());

                if (Storage::disk('public')->put($path . '/' . $filename, File::get($file))) {
                    $input['filename'] = $filename;
                    $input['mime'] = $file->getClientMimeType();
                    $input['path'] = $path;
                    $input['size'] = $file->getClientSize();
                    $input['listing_id'] = $listingID;

                    $upload = Upload::forceCreate($input);
                    $uploads[] = $upload;
                } else {
                    return response()->json(
                        [
                            'status' => 'error',
                            'message' => 'An error occurred while uploading file ' . $filename,
                        ],
                        500
                    );
                }
            }
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Successfully uploaded the file(s)',
                'data' => $uploads
            ],
            200
        );
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $fileName = request('file_name');
        $fileSize = request('file_size');
        $listingId = request('listing_id');

        // Delete the first file that matches the critieron. I can't use id's because of how the JS is setup
        $upload = Listing::find($listingId)->uploads()->where([
            ['filename', '=', $fileName],
            ['size', '=', $fileSize]
        ])->first();

        try {
            // Delete the physical file
            Storage::disk('public')->delete($upload->path . '/' . $upload->filename);
            // Delete the db record
            $upload->delete();

        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'An error occurred while trying to delete the file'
                ],
                500
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Photo was successfully deleted.'
            ],
            200
        );
    }
}
