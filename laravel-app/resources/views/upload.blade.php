<!DOCTYPE html>
<html>
<head>
    <title>Wound Detection</title>
</head>
<body>

<h1>Upload Image</h1>

<form action="/predict" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="image" required>

    <button type="submit">
        Predict
    </button>
</form>

@if(isset($result))

    <h2>Result</h2>

    <p>
        Class:
        {{ $result['class'] }}
    </p>

    <p>
        Confidence:
        {{ round($result['confidence'] * 100, 2) }}%
    </p>

@endif

</body>
</html>