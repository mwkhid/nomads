<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $item = TravelPackage::with(['galleries']) // panggil relasi dengan gallery
            ->where('slug', $slug) // cek apalkah slug pada url sama dengan slug database
            ->firstOrFail(); // panggil yang pertama atau tidak ada
        return view('pages.detail', [
            'item' => $item
        ]);
    }
}