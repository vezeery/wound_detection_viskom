<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    #Controller ini untuk mengangani request utuk melakukan prediksi pada model yang sudah dibuat, dengan cara mengirimkan file gambar ke server yang menjalankan model tersebut, lalu menerima hasil prediksi dan menampilkannya pada view upload.blade.php

    public function predict(Request $request)
    {
        #merespon request dari upload gambar.
        $response = Http::attach(
            'file',
            file_get_contents($request->file('image')->getRealPath()),
            $request->file('image')->getClientOriginalName()
            #mengirimkan file gambar ke server yang menjalankan model prediksi
        )->post('http://127.0.0.1:8001/predict');
        #mengirimkan request POST ke server fastAPI yang menjalankan model prediksi dengan endpoint /predict.

        $result = $response->json();
        #memberikan hasil dalam format json dari fastAPI

        return view('upload', compact('result'));
        #mengembalikan view dari blade upload serta hasil model prediksi dari fastAPI.
    }
}