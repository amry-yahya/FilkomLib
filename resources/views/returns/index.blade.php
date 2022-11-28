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

                        <table class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">user_id</th>
                                    <th scope="col">book_id</th>
                                    <th scope="col">setujui peminjaman</th>
                                    <th scope="col">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($returns as $return)
                                    <tr>
                                        <td>{{ $return->user_id }}</td>
                                        <td>{{ $return->book_id }}</td>
                                        <td>{{ $return->accept_borrow }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('return.destroy', $return->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if ($return->propose_return)
                                                <button type="submit" class="btn btn-sm btn-success">SETUJUI PENGEMBALIAN</button>
                                                @else 
                                                Pengembalian belum diajukan
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-mute" colspan="4">Data return tidak tersedia</td>
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
