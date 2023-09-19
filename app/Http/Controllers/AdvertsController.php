<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Alert;
use App\Models\Advert;
use Auth;


class AdvertsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Adverts';
        $adverts = Advert::orderBy('created_at', 'desc')->cursorPaginate(50);
        return view('admin-pages.adverts-index')->with(compact('title', 'adverts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $title = 'Add Advert';
      return view('admin-pages.add-advert')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $completeUrl = $this->uploadImage($request->file('image_url'));

        $data = $request->only(['title', 'description', 'brand', 'advert_url']);
        $data['image_url'] = $completeUrl;
        $data['added_by'] = Auth::user()->username;

        Advert::create($data);

        return redirect()->back()->with('alerted', Alert::success('Advert Added', 'You have added an advert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advert $advert)
    {
        $title = 'Edit Advert';
        return view('admin-pages.edit-advert')->with(compact('title', 'advert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advert $advert)
    {
        if ($request->hasFile('image_url')) {
            $this->deleteImageFromStorage($advert->image_url);
            $advert->image_url = $this->uploadImage($request->file('image_url'));
        }

        $data = $request->only(['title', 'description', 'brand', 'advert_url']);
        $advert->fill($data)->save();

        return redirect()->back()->with('alerted', Alert::success('Edited', 'Your advert has been edited'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advert $advert)
    {
        $this->deleteImageFromStorage($advert->image_url);
        $advert->delete();

        $alerted = Alert::success('Advert Deleted', 'The advert has been deleted');
        return redirect()->back()->with('alerted');
    }

    private function deleteImageFromStorage($image_url)
    {
        // Get the path of the image file from the URL
        $path = str_replace('/storage', 'public', $image_url);

        // Check if the file exists in storage
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    private function uploadImage($imageFile)
    {
        if (!$imageFile) {
            return null;
        }

        $filenameWithExt = $imageFile->getClientOriginalName();
        $extension = $imageFile->getClientOriginalExtension();
        $randSlug = Str::random(50);
        $fileNameToStore = "{$randSlug}_" . time() . ".{$extension}";
        $path_url = $imageFile->storeAs('public/images/advert-images', $fileNameToStore);
        return Storage::url($path_url);
    }

}
