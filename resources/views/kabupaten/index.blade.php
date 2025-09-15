@extends('template.base')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kabupaten</h1>
        <a href="{{ url('kabupaten/tambah') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kabupaten</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kabupaten</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kabupaten</th>
                            <th>Nama Kabupaten</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Kabupaten</th>
                            <th>Nama Kabupaten</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data['kabupatens'] as $kabupaten)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kabupaten->kodekabupaten }}</td>
                            <td>{{ $kabupaten->namakabupaten }}</td>
                            <td>
                                <div class="btn-group btn-block">
                                    <div class="btn-group dropleft" role="group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropleft</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ url('kabupaten/hapus/' . Crypt::encrypt($kabupaten->kodekabupaten)) }}" class="dropdown-item" id="btnHapus">Hapus</a>
                                        </div>
                                    </div>
                                    <a href="{{ url('kabupaten/edit/' . Crypt::encrypt($kabupaten->kodekabupaten)) }}" class="btn btn-warning">Edit</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('kabupaten/listindex') }}",
            columns: [
                { data: 'no', name: 'no' },
                { data: 'kodekabupaten', name: 'kodekabupaten' },
                { data: 'namakabupaten', name: 'namakabupaten' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
