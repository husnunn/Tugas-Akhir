@extends('layouts.app')

@section('content')
    <div class="container">
        <h5 class="mb-3">Form P8 - Kelembagaan Desa</h5>

        <form action="{{ route('desa-p8.store') }}" class="mb-5" method="POST">
            @csrf
            <h5>Daftar Lembaga</h5>
            <div id="lembaga-wrapper">
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label>Lembaga</label>
                            <select name="id_lembaga" class="form-control" required>
                                <option value="">-- Pilih Lembaga --</option>
                                @foreach ($lembaga ?? [] as $item)
                                    <option value="{{ $item->id_lembaga }}">{{ $item->nama_lembaga }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label>Jumlah Pengurus</label>
                            <input type="number" name="jml_pengurus" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label>Jumlah Anggota</label>
                            <input type="number" name="jml_anggota" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== Tombol Aksi ====== --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('desa-p2.index') }}" class="btn btn-secondary">
                    ← Kembali
                </a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lembaga</th>
                        <th>Jumlah Pengurus</th>
                        <th>Jumlah Anggota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_lembaga }}</td>
                            <td>{{ $item->jml_pengurus }}</td>
                            <td>{{ $item->jml_anggota }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning btn-edit-user" data-toggle="modal"
                                    data-target="#modalEditUser">
                                    Edit
                                </button>
                                <form action="{{ route('desa-p8.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus Data ini?')">
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')

    <script>
        let table = new DataTable('#dataTable', {
            responsive: true
        });
    </script>