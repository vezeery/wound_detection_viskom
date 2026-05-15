<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wound Detection System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f7fb;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
            color: #1f2937;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .upload-box {
            border: 2px dashed #cbd5e1;
            border-radius: 14px;
            padding: 30px;
            text-align: center;
            transition: 0.3s;
            background: #f8fafc;
        }

        .upload-box:hover {
            border-color: #2563eb;
            background: #eff6ff;
        }

        input[type="file"] {
            margin-top: 15px;
        }

        .btn {
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .result-card {
            margin-top: 25px;
            padding: 20px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .result-title {
            margin-bottom: 15px;
            color: #111827;
            font-size: 20px;
        }

        .result-item {
            margin-bottom: 10px;
            color: #374151;
            font-size: 15px;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            background: #dbeafe;
            color: #1d4ed8;
            font-weight: bold;
            font-size: 14px;
        }

        .preview {
            width: 100%;
            margin-top: 20px;
            border-radius: 12px;
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <h1 class="title">
                Wound Detection
            </h1>

            <p class="subtitle">
                Upload wound image for AI classification
            </p>

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/predict" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="upload-box">

                    <p>
                        Select image to analyze
                    </p>

                    <input type="file" name="image" id="imageInput" accept="image/*" required>

                    <img id="preview" class="preview">

                </div>

                <button type="submit" class="btn">
                    Predict Image
                </button>

            </form>

            @if (isset($result))
                <div class="result-card">

                    <h2 class="result-title">
                        Prediction Result
                    </h2>

                    <div class="result-item">
                        Detected Class:
                    </div>

                    <span class="badge">
                        {{ $result['class'] }}
                    </span>

                    <div class="result-item" style="margin-top:15px;">
                        Confidence:
                        <strong>
                            {{ round($result['confidence'] * 100, 2) }}%
                        </strong>
                    </div>

                </div>
            @endif

        </div>

    </div>

    <script>
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');

        imageInput.addEventListener('change', function(e) {

            const file = e.target.files[0];

            if (file) {

                preview.src = URL.createObjectURL(file);

                preview.style.display = 'block';
            }

        });
    </script>

</body>

</html>
