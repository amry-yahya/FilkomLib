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
                        <h3 class="text-center">Daftar Pengajuan Pengembalian Buku</h3>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Kode Buku</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Deadline Pengembalian</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($returns as $return)
                                    <tr>
                                        <td>{{ $return->user_nim }}</td>
                                        <td>{{ $return->book_id }}</td>
                                        <td>{{ $return->date }}</td>
                                        <td>{{ $return->date_return }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('return.destroy', $return->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if ($return->propose_return)
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda Yakin ?');">SETUJUI PENGEMBALIAN</button>
                                                @else 
                                                Pengembalian belum diajukan
                                                @endif
                                            </form>
                                            <a href="{{ route('borrowing.show', $return->user_id) }}"
                                                class="btn btn-sm btn-primary">LIHAT PROFIL</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-mute" colspan="5">Data tidak tersedia</td>
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
