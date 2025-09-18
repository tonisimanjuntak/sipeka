@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PERSYARATAN DASAR</h1>
    </div>

    <form method="POST" id="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ltambah" id="ltambah" value="{{ $ltambah }}">
        <div class="row">
            <!-- Area Chart -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary label-judul"><a href="{{ url('persyaratandasar') }}">LIST DATA PERSYARATAN DASAR</a> / <span class="label-aksi"></span> </h6><span class="float-end id-primary"></span>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">                            
                            
                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="idpersyaratandasar" class="col-md-3 col-form-label">Kode Persyaratan</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="idpersyaratandasar" id="idpersyaratandasar" placeholder="Kode persyaratan" autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="namapersyaratandasar" class="col-md-3 col-form-label">Nama Persyaratan</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="namapersyaratandasar" id="namapersyaratandasar" placeholder="Nama persyaratan">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="batasminimalkabupaten" class="col-md-3 col-form-label">Jumlah Minimal Untuk Kabupaten</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="batasminimalkabupaten" id="batasminimalkabupaten" placeholder="0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="batasminimalkota" class="col-md-3 col-form-label">Jumlah Minimal Untuk Kotamadya</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="batasminimalkota" id="batasminimalkota" placeholder="0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 required" id="divstatus">
                                <div class="form-group row">
                                    <label for="namapersyaratandasar" class="col-md-3 col-form-label">Status Aktif</label>
                                    <div class="col-md-9">
                                        <select name="statusaktif" id="statusaktif" class="form-control select2">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm float-right" id="btnSimpan"><i class="fa fa-save mr-1"></i>Simpan</button>
                        <a href="{{ url('persyaratandasar') }}" class="btn btn-default btn-sm float-right mr-3">Kembali</a>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->

        </div>
    </form>


</div>
<!-- /.container-fluid -->
    
@endsection


@section('javascript')
    
<script>
    var idpersyaratandasar = "{{ $idpersyaratandasar }}";

    $(document).ready(function() {

        $('.select2').select2();

        if (idpersyaratandasar != "") {
            $('#idpersyaratandasar').val(idpersyaratandasar);
            $('.id-primary').html('ID: ' + idpersyaratandasar);
            $('.label-judul .label-aksi').html('Edit');

            $.ajax({
                    url: "{{ url('persyaratandasar/getId') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpersyaratandasar': idpersyaratandasar
                    },
                })
                .done(function(response) {
                    console.log(response);
                    $('#namapersyaratandasar').val(response['namapersyaratandasar']);
                    $('#batasminimalkabupaten').val(response['batasminimalkabupaten']);
                    $('#batasminimalkota').val(response['batasminimalkota']);
                    $('#statusaktif').val(response['statusaktif']).trigger('change');
                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            $('.label-judul .label-aksi').html('Tambah');
        }

        $('#form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    idpersyaratandasar: {
                        validators: {
                            notEmpty: {
                                message: 'kode persyaratan tidak boleh kosong'
                            },
                            stringLength: {
                                min: 3,
                                max: 3,
                                message: 'minimal 3 karakter'
                            },
                        }
                    },
                    namapersyaratandasar: {
                        validators: {
                            notEmpty: {
                                message: 'nama persyaratan tidak boleh kosong'
                            },
                            stringLength: {
                                max: 255,
                                message: 'maksimal 255 karakter'
                            },
                        }
                    },
                    batasminimalkabupaten: {
                        validators: {
                            notEmpty: {
                                message: 'batas minimal tidak boleh kosong'
                            },
                        }
                    },
                    batasminimalkota: {
                        validators: {
                            notEmpty: {
                                message: 'batas minimal tidak boleh kosong'
                            },
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                e.preventDefault(); // Cegah submit default

                const $form = $(e.target);
                const formData = $form.serialize(); // Ambil semua input

                $('#btnSimpan').prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');

                // Kirim via AJAX
                $.ajax({
                    url: "{{ url('persyaratandasar/simpan') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#btnSimpan').prop('disabled', false).html('<i class="fa fa-save mr-1"></i>Simpan');

                        if (response.success) {
                            swal('Berhasil!', 'Data berhasil disimpan.', 'success')
                            .then(() => {
                                window.location.href = "{{ url('persyaratandasar') }}";
                            });
                        } else {
                            swal('Gagal!', response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        $('#btnSimpan').prop('disabled', false).html('<i class="fa fa-save mr-1"></i>Simpan');

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
            });

        $("form").attr('autocomplete', 'off');
        $("#idpersyaratandasar").mask("000", {
            reverse: true,
            placeholder: "Kode persyaratan"
        });

        document.getElementById('batasminimalkabupaten').addEventListener('input', function (event) {
            let value = event.target.value;

            // Hapus karakter yang tidak valid (hanya angka dan koma yang diperbolehkan)
            value = value.replace(/[^0-9.]/g, '');

            // Pastikan hanya ada satu koma
            let parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts[1];
            }

            // Update nilai input
            event.target.value = value;
        });

        document.getElementById('batasminimalkota').addEventListener('input', function (event) {
            let value = event.target.value;

            // Hapus karakter yang tidak valid (hanya angka dan koma yang diperbolehkan)
            value = value.replace(/[^0-9.]/g, '');

            // Pastikan hanya ada satu koma
            let parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts[1];
            }

            // Update nilai input
            event.target.value = value;
        });
    });

    
</script>

@endsection