<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoundDetect - AI Wound Detection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8faff; font-family: 'Inter', sans-serif; }
        .gradient-text { background: linear-gradient(90deg, #4f46e5, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="antialiased">

    <nav class="flex justify-between items-center px-12 py-6">
        <div class="flex items-center gap-2">
            <div class="bg-blue-600 p-2 rounded-lg text-white">
                <i class="fas fa-plus-square"></i>
            </div>
            <div>
                <h1 class="font-bold text-xl leading-none">WoundDetect</h1>
                <p class="text-xs text-gray-500">AI Wound Detection</p>
            </div>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2 rounded-xl flex items-center gap-2 hover:bg-indigo-700 transition">
            <i class="fas fa-upload text-sm"></i> Upload Gambar
        </button>
    </nav>

    <main class="max-w-7xl mx-auto px-12 mt-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <div>
            <h2 class="text-6xl font-extrabold text-slate-900 leading-tight">
                Deteksi Luka <br>
                <span class="gradient-text">Cepat, Akurat, dan Terpercaya</span>
            </h2>
            <p class="text-gray-500 mt-6 text-lg max-w-lg">
                WoundDetect menggunakan AI untuk membantu mendeteksi berbagai jenis luka pada kulit dengan cepat dan akurat.
            </p>

            <button class="mt-8 bg-indigo-600 text-white px-8 py-3 rounded-xl flex items-center gap-2 shadow-lg shadow-indigo-200 hover:scale-105 transition">
                <i class="fas fa-upload"></i> Upload Gambar Luka
            </button>

            <div class="grid grid-cols-3 gap-8 mt-16">
                <div class="space-y-3">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center text-indigo-600">
                        <i class="fas fa-bullseye text-xl"></i>
                    </div>
                    <h4 class="font-bold">Akurasi Tinggi</h4>
                    <p class="text-xs text-gray-500">Model AI terlatih dengan dataset medis berkualitas.</p>
                </div>
                <div class="space-y-3">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center text-indigo-600">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <h4 class="font-bold">Aman & Privasi</h4>
                    <p class="text-xs text-gray-500">Gambar tidak disimpan, privasi Anda terlindungi.</p>
                </div>
                <div class="space-y-3">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center text-indigo-600">
                        <i class="fas fa-bolt text-xl"></i>
                    </div>
                    <h4 class="font-bold">Hasil Instan</h4>
                    <p class="text-xs text-gray-500">Dapatkan hasil deteksi dalam hitungan detik.</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[40px] shadow-2xl shadow-blue-100 border border-gray-50">
            <h3 class="font-bold text-lg mb-1">Upload gambar luka Anda</h3>
            <p class="text-sm text-gray-400 mb-6">Format: JPG, PNG (Max. 10MB)</p>

            <form action="{{ route('wound.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <label class="border-2 border-dashed border-gray-200 rounded-3xl p-10 flex flex-col items-center justify-center text-gray-400 mb-8 cursor-pointer hover:bg-gray-50 transition block">
                    <i class="fas fa-cloud-upload-alt text-4xl text-indigo-400 mb-4"></i>
                    <p>Klik untuk pilih gambar luka</p>
                    <input type="file" name="image" class="hidden" onchange="document.getElementById('uploadForm').submit()">
                </label>
            </form>

            <div class="bg-slate-50 rounded-3xl p-6 border border-gray-100">
                <h4 class="font-bold text-sm mb-4">Contoh Hasil Deteksi</h4>
                <div class="flex gap-4">
                    <img src="{{ asset('images/example.png') }}" class="w-32 h-32 rounded-2xl object-cover" alt="Wound Example">
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-xs text-gray-400">Jenis Luka</p>
                                <h5 class="text-indigo-700 font-bold text-xl">Abrasions</h5>
                            </div>
                            <span class="bg-green-100 text-green-600 text-[10px] font-bold px-2 py-1 rounded-md">92%</span>
                        </div>
                        <p class="text-[10px] text-gray-400 leading-tight mb-2 uppercase font-semibold">Deskripsi</p>
                        <p class="text-xs text-gray-600 mb-4">Luka gesek pada permukaan kulit akibat terkena benda kasar.</p>

                        <div class="flex items-start gap-2 text-[10px] text-gray-400 bg-white p-2 rounded-lg border border-gray-100">
                            <i class="fas fa-info-circle mt-0.5"></i>
                            <p>Hasil ini bukan diagnosis medis. Konsultasikan dengan tenaga medis untuk evaluasi lebih lanjut.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="max-w-4xl mx-auto mt-12 bg-indigo-50/50 border border-indigo-100 rounded-full py-3 flex items-center justify-center gap-3 text-indigo-600 text-sm">
        <i class="fas fa-check-circle"></i>
        <span>Didukung oleh teknologi AI • Cepat • Akurat • Terpercaya</span>
    </div>

    <footer class="text-center py-10 text-gray-400 text-xs">
        © 2024 WoundDetect. Semua hak dilindungi.
    </footer>

</body>
</html>
