<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Menu</title>
    <style>
        body {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            background: radial-gradient(circle at top left, #f6efe6, #dcc6ad);
            color: #3e2723;
        }

        .wrap {
            max-width: 980px;
            margin: 32px auto;
            background: #fffdf8;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 10px 24px rgba(62, 39, 35, 0.18);
        }

        h1 {
            margin-top: 0;
            color: #5d4037;
        }

        .toolbar {
            margin-bottom: 18px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background: #6d4c41;
            color: #fff;
            padding: 9px 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-danger {
            background: #b23a2a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            border-bottom: 1px solid #eddcca;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f5e6d6;
            color: #4e342e;
        }

        .flash-success {
            background: #e7f7ed;
            color: #14532d;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 14px;
        }

        .action-form {
            display: inline;
        }

        .empty {
            text-align: center;
            color: #7a5c4e;
        }

        @media (max-width: 768px) {
            .wrap {
                margin: 16px;
                padding: 16px;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 12px;
                border: 1px solid #eddcca;
                border-radius: 8px;
                padding: 8px;
            }

            td {
                border: none;
                padding: 6px 0;
            }
        }
    </style>
</head>
<body>
<div class="wrap">
    <h1>Daftar Menu Coffee Shop</h1>

    @if (session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <div class="toolbar">
        <a href="{{ route('coffees.create') }}" class="btn">+ Tambah Menu Kopi</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($coffees as $coffee)
            <tr>
                <td>{{ $coffee->name }}</td>
                <td>{{ $coffee->description ?: '-' }}</td>
                <td>Rp {{ number_format((float) $coffee->price, 0, ',', '.') }}</td>
                <td>{{ $coffee->stock }}</td>
                <td>
                    <a href="{{ route('coffees.edit', $coffee) }}" class="btn">Ubah</a>

                    <form method="POST" action="{{ route('coffees.destroy', $coffee) }}" class="action-form" onsubmit="return confirm('Hapus menu ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="empty">Belum ada menu kopi.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
