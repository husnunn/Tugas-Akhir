@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Tombol Tambah Lembaga --}}
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambahLembaga">
            + Tambah Lembaga
        </button>

        {{-- Tabel Lembaga --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Lembaga</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Lembaga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lembaga as $j)
                                <tr>
                                    <td>{{ $j->id_lembaga }}</td>
                                    <td>{{ $j->nama_lembaga }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning btn-edit-Lembaga"
                                            data-id="{{ $j->id }}" data-nama_Lembaga="{{ $j->nama_lembaga }}"
                                            data-toggle="modal" data-target="#modalEditLembaga">
                                            Edit
                                        </button>

                                        <form action="" method="POST"
                                        {{-- {{ route('lembaga.destroy', $j->id) }} --}}
                                            class="d-inline" onsubmit="return confirm('Hapus Lembaga ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Lembaga --}}
    {{-- <div class="modal fade" id="modalTambahLembaga" tabindex="-1" aria-labelledby="modalTambahLembagaLabel">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLembagaLabel">Tambah Lembaga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Lembaga.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>ID Lembaga</label>
                            <input type="text" name="id" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Lembaga</label>
                            <input type="text" name="nama_Lembaga" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Lembaga</button>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Modal Edit Lembaga --}}
    {{-- <div class="modal fade" id="modalEditLembaga" tabindex="-1" aria-labelledby="modalEditLembagaLabel">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLembagaLabel">Edit Lembaga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form id="formEditLembaga" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label>ID Lembaga</label>
                                <input type="text" name="id" id="edit_id" class="form-control" required readonly>
                            </div>
                            <div class="mb-3">
                                <label>Nama Lembaga</label>
                                <input type="text" name="nama_Lembaga" id="edit_nama_Lembaga" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <script>
        $(document).ready(function() {
            $('#modalEditLembaga').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var namaLembaga = button.data('nama_Lembaga');
                console.log('ID:', id, 'Nama:', namaLembaga); // harus keluar saat klik edit
                $('#formEditLembaga').attr('action', '/Lembaga/' + id);
                $('#edit_id').val(id); // <-- TAMBAHKAN INI
                $('#edit_nama_Lembaga').val(namaLembaga);

            });
        });
    </script> --}}



@endsection
