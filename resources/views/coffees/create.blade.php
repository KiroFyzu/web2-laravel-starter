<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Kopi</title>
    <style>
        body {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            background: linear-gradient(135deg, #f7efe5 0%, #ead7c3 100%);
            color: #3e2723;
        }

        .container {
            max-width: 720px;
            margin: 40px auto;
            background: #fffdf8;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 10px 24px rgba(62, 39, 35, 0.18);
        }

        h1 {
            margin-top: 0;
            color: #5d4037;
        }

        label {
            display: block;
            margin-top: 14px;
            margin-bottom: 6px;
            font-weight: 700;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #bca28a;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 15px;
        }

        button {
            margin-top: 16px;
            background: #6d4c41;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            cursor: pointer;
        }

        a {
            color: #4e342e;
            text-decoration: none;
            margin-left: 10px;
            font-weight: 600;
        }

        .error-list,
        .error-box {
            background: #fdecea;
            color: #8a1f11;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 16px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Tambah Menu Coffee Shop</h1>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @error('store_error')
        <div class="error-box">{{ $message }}</div>
    @enderror

    <form method="POST" action="{{ route('coffees.store') }}">
        @csrf

        <label for="name">Nama Kopi</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required>

        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>

        <label for="price">Harga</label>
        <input id="price" type="number" name="price" min="0" step="0.01" value="{{ old('price') }}" required>

        <label for="stock">Stok</label>
        <input id="stock" type="number" name="stock" min="0" value="{{ old('stock', 0) }}" required>

        <button type="submit">Simpan Menu</button>
        <a href="{{ route('coffees.index') }}">Kembali ke daftar</a>
    </form>
</div>
</body>
</html>
