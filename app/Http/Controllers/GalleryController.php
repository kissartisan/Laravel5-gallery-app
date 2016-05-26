<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Gallery;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /* For authentication of the login */
    public function __construct() {
        $this->middleware('auth');
    }

    public function viewGallery() {
        if (Auth::check()) {
            $user = Auth::user();
            // Only show the galleries with its respective user
            $galleries = Gallery::where('created_by', Auth::user()->id)->get();

            return view('gallery.gallery')->with('galleries', $galleries)->with('user', $user);
        }
    }

    public function saveGallery(Request $request) {
    	# Validate the Request through the validation rules
    	$validator = Validator::make($request->all(), [
    		'gallery_name' => 'required|unique:gallery,name|min:3',
    	]);

    	# Take actions when the validation has failed
    	if ($validator->fails()) {
    		return redirect('gallery/list')
    		->withErrors($validator)
    		->withInput();
    	}

    	$gallery = new Gallery;
    	# Save a new Gallery
    	$gallery->name = $request->input('gallery_name');
    	$gallery->created_by = Auth::user()->id;
    	$gallery->published = 1;
    	$gallery->save();

    	return redirect()->back();
    }

    public function viewGalleryPics($id) {
    	$gallery = Gallery::findOrFail($id);

    	// return view('gallery.gallery-view')->with('gallery', $gallery);
        return view('gallery.gallery-view', compact('gallery'));
    }

    public function doImageUpload(Request $request) {
        # Get the file from the post request
        $file = $request->file('file');

        # Set the file name
        $filename = uniqid() . $file->getClientOriginalName();

        # Check for the folder
        if (!file_exists('gallery/images')) {
            mkdir('gallery/images', 0777, true);
        }

        # Move the file to correct location
        $file->move('gallery/images', $filename);

        # Check for the folder
        if (!file_exists('gallery/images/thumbs')) {
            mkdir('gallery/images/thumbs', 0777, true);
        }

        $thumb = Image::make('gallery/images/' . $filename)->resize(240, 160)->save('gallery/images/thumbs/' . $filename, 60);

        # And save the image to the database
        $gallery = Gallery::find($request->input('gallery_id'));
        $image = $gallery->images()->create([
            'gallery_id' => $request->input('gallery_id'),
            'file_name' => $filename,
            'file_size' => $file->getClientSize(),
            'file_mime' => $file->getClientMimeType(),
            'file_path' => 'gallery/images/' . $filename,
            'created_by' => Auth::user()->id,
        ]);

        return $image;
    }

    public function deleteGallery($id)
    {
        # Load the gallery
        $currentGallery = Gallery::findOrFail($id);

        # Check ownership
        if ($currentGallery->created_by != Auth::user()->id) {
            abort('403', 'You are not allowed to delete this gallery');
        }

        # Get the images
        $images = $currentGallery->images();

        # Delete the images
        foreach ($currentGallery->images as $image) {
            unlink(public_path($image->file_path)); // public_path function returns the fully qualified path to the public directory
            unlink(public_path('gallery/images/thumbs/' . $image->file_name)); // public_path function returns the fully qualified path to the public directory
        }

        # Delete the DB records
        // $images->delete();
        $currentGallery->images()->delete();
        $currentGallery->delete();

        return redirect()->back();
    }
}

