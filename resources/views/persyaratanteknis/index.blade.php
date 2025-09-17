@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PERSYARATAN TEKNIS</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown --> 
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">LIST DATA PERSYARATAN TEKNIS</h6>
                    <a href="{{ url('persyaratanteknis/tambah') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 mb-3">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Filter Status:</label>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statusFilter" id="semua" value="Semua" checked>
                                        <label class="form-check-label" for="semua">Semua</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statusFilter" id="aktif" value="Aktif">
                                        <label class="form-check-label" for="aktif">Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statusFilter" id="tidakAktif" value="Tidak Aktif">
                                        <label class="form-check-label" for="tidakAktif">Tidak Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table table-bordered" id="tableIndex" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align:center;">NO</th>
                                        <th style="width: 10%; text-align:center;">KODE</th>
                                        <th style="text-align:center;">NAMA PERSYARATAN</th>
                                        <th style="width: 15%; text-align:center;">STATUS</th>
                                        <th style="width: 10%; text-align:center;">AKSI</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->

    </div>

</div>
<!-- /.container-fluid -->
    
@endsection


@section('javascript')
    
<script>
    var table;

    $(document).ready(function() {
        table = $('#tableIndex').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('persyaratanteknis/listindex') }}",
                type: 'GET',
                data: function(d) {
                    d.statusFilter = $('input[name="statusFilter"]:checked').val();
                }
            },
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            columns: [{
                    data: 'no',
                    name: 'no',
                    orderable: false,
                    className: 'dt-body-center',
                    searchable: false
                },
                {
                    data: 'idpersyaratanteknis',
                    name: 'idpersyaratanteknis',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'namapersyaratanteknis',
                    name: 'namapersyaratanteknis',
                    className: 'dt-body-left',
                    orderable: true,
                },
                {
                    data: 'statusaktif',
                    name: 'statusaktif',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ entri",
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                emptyTable: "Tidak ada data yang tersedia",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                loadingRecords: "Memuat...",
                processing: "Sedang memproses...",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });

        $('input[name="statusFilter"]').on('change', function() {
            table.ajax.reload();
        });

    });

    $(document).on('click', '#btnHapus', function(e) {
        var link = $(this).attr("href");
        e.preventDefault();
        swal({
                title: "Hapus?",
                text: "Apakah anda yakin akan menghapus data ini!",
                icon: "warning",
                buttons: ["Batal", "Ya"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    
                    $.ajax({
                        url: link,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                swal('Berhasil!', 'Data berhasil dihapus.', 'success')
                                .then(() => {
                                    window.location.href = "{{ url('persyaratanteknis') }}";
                                });
                            } else {
                                swal('Gagal!', response.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            let message = 'Terjadi kesalahan.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            } else if (xhr.status === 422) {
                                // Validation errors
                                const errors = xhr.responseJSON.errors;
                                message = Object.values(errors).flat().join('<br>');
                            }
                            swal('Error!', message, 'error');
                        }
                    });
                }
            });

    });
</script>

@endsection