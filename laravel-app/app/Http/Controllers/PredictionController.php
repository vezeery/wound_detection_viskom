<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PredictionController extends Controller
{
    #Controller ini untuk mengangani request utuk melakukan prediksi pada model yang sudah dibuat,
    #dengan cara mengirimkan file gambar ke server yang menjalankan model tersebut, lalu menerima hasil prediksi dan menampilkannya pada view upload.blade.php

    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        try {
            // attach and send image to prediction service
            $imagePath = $request->file('image')->store('uploads', 'public');

            $response = Http::attach(
                'file',
                file_get_contents($request->file('image')->getRealPath()),
                $request->file('image')->getClientOriginalName()
            )->post('http://127.0.0.1:8001/predict');

            // network / server error
            if (! $response->successful()) {
                Log::error('Prediction API returned non-success status', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return back()->with('error', 'Layanan prediksi sedang bermasalah. Silakan coba lagi dalam beberapa saat.');
            }

            $result = $response->json();

            // validate result format (expecting non-empty array/object)
            if (! is_array($result) && ! is_object($result)) {
                Log::error('Prediction API returned unexpected format', ['raw' => $response->body()]);
                return back()->with('error', 'Hasil prediksi tidak dalam format yang diharapkan.');
            }

            // additional basic check: must not be empty
            if (empty((array) $result)) {
                Log::warning('Prediction API returned empty result', ['body' => $response->body()]);
                return back()->with('error', 'Hasil prediksi kosong. Pastikan gambar valid dan coba lagi.');
            }

            return view('welcome', [
                'result' => $result,
                'imagePath' => $imagePath
        ]);

        } catch (\Throwable $e) {
            // log full exception for debugging and return friendly message
            Log::error('Exception when calling prediction API', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat memproses gambar. Silakan coba lagi nanti.');
        }
    }
}
