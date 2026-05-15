<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WoundController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('wounds', 'public');

            return back()->with('success', 'Gambar berhasil diupload ke: ' . $path);
        }

        return back()->with('error', 'Gagal upload gambar.');

        return view('upload');
    }
}
