@extends('layouts.app')
@section('content')
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">

                <!-- Notifikasi menggunakan flash session data -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h3 class="text-center">Daftar Buku</h3>
                        
                        @can('create books', Book::class)
                        <a href="{{ route('book.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Buku</a>
                        @endcan

                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Penulis</th>
                                    <th scope="col">Tahun Terbit</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr>
                                        <td>{{ $book->code }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->writer }}</td>
                                        <td>{{ $book->year }}</td>
                                        <td class="text-center">
                                            @can('edit books', Buku::class)
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('book.destroy', $book->id) }}" method="POST">
                                                <a href="{{ route('book.edit', $book->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                            @endcan
                                            @can('borrow books', Buku::class)
                                            <form action="{{ route('borrowing.store') }}" method="POST">
                                                @csrf
                                                <input type="number" value="{{ $book->id }}" name="book_id" hidden>
                                                <input type="number" value="{{ auth()->user()->id }}" name="user_id" hidden>
                                                <input type="text" value="{{ auth()->user()->nim }}" name="user_nim" hidden>
                                                <input type="text" value="{{ $book->code }}" name="book_code" hidden>
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda Yakin ?');">PINJAM</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-mute" colspan="4">Data book tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
