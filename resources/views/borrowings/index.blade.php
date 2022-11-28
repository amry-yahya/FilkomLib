@extends('layouts.app')
@section('content')
@can('manage borrowings', Borrowing::class)
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
                        <h3 class="text-center">Daftar Pengajuan Peminjaman Buku</h3>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">NIM</th>
                                    <th scope="col">book_id</th>
                                    <th scope="col">tanggal peminjaman</th>
                                    <th scope="col">deadline pengembalian</th>
                                    <th scope="col">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrowings as $borrowing)
                                <tr>
                                    <td>{{ $borrowing->user_nim }}</td>
                                    <td>{{ $borrowing->book_id }}</td>
                                    <td>{{ $borrowing->date }}</td>
                                    <td>{{ $borrowing->date_return }}</td>
                                    <td>
                                        <form action="{{ route('borrowing.update',$borrowing->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" value="{{ $borrowing->book_id }}" name="book_id" hidden>
                                            <input type="number" value="{{ $borrowing->user_id }}" name="user_id" hidden>
                                            <input type="number" value="{{ $borrowing->user_nim }}" name="user_nim" hidden>
                                            <button type="submit" class="btn btn-sm btn-success">SETUJUI PEMINJAMAN</button>
                                            <a href="{{ route('borrowing.show', $borrowing->user_id) }}"
                                                class="btn btn-sm btn-primary">LIHAT PROFIL</a>
                                        </form>
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
@endcan
@endsection
