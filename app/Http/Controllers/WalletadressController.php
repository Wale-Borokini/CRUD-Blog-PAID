<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Walletadress;
use Auth;
Use Alert;


class WalletadressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Wallet Addresses';
        $walletaddresses = Walletadress::orderBy('title')->get();
        return view('admin-pages.wallet-address-index')->with(compact('title', 'walletaddresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Wallet Address';
        return view('admin-pages.add-wallet-address')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $completeUrl = $this->uploadImage($request->file('image_url'));

        $data = $request->only(['title', 'btc_address', 'amount', 'btc_service']);
        $data['image_url'] = $completeUrl;
        $data['added_by'] = Auth::user()->username;

        Walletadress::create($data);

        return redirect()->back()->with('alerted', Alert::success('Wallet Address Added', 'You have added a Wallet Address'));

    }   
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Walletadress $wallet)
    {
        $title = 'Edit Wallet Address';
        return view('admin-pages.edit-wallet-address')->with(compact('title', 'wallet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Walletadress $wallet)
    {
        if ($request->hasFile('image_url')) {
            $this->deleteImageFromStorage($wallet->image_url);
            $wallet->image_url = $this->uploadImage($request->file('image_url'));
        }

        $data = $request->only(['title', 'btc_address', 'amount', 'btc_service']);
        $wallet->fill($data)->save();

        return redirect()->back()->with('alerted', Alert::success('Edited', 'Your wallet address has been edited'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Walletadress $wallet)
    {
        $this->deleteImageFromStorage($wallet->image_url);
        $wallet->delete();

        $alerted = Alert::success('Address Deleted', 'The wallet address has been deleted');
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
        $path_url = $imageFile->storeAs('public/images/wallet-images', $fileNameToStore);
        return Storage::url($path_url);
    }
}