@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">KELURAHAN/ DESA</h1>
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
                        <h6 class="m-0 font-weight-bold text-primary label-judul"><a href="{{ url('kelurahan') }}">LIST DATA KELURAHAN/ DESA</a> / <span class="label-aksi"></span> </h6><span class="float-end id-primary"></span>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">                            
                            
                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="kodekabupaten" class="col-md-3 col-form-label">Nama Kabupaten</label>
                                    <div class="col-md-9">
                                        <select name="kodekabupaten" id="kodekabupaten" class="form-control searchKabupaten"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="kodekecamatan" class="col-md-3 col-form-label">Nama Kecamatan</label>
                                    <div class="col-md-9">
                                        <select name="kodekecamatan" id="kodekecamatan" class="form-control searchKecamatan"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="kodekelurahan" class="col-md-3 col-form-label">Kode Kelurahan/ Desa</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control kode-kelurahan" name="kodekelurahan" id="kodekelurahan" placeholder="Kode kelurahan/ desa" autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="namakelurahan" class="col-md-3 col-form-label">Nama Kelurahan/ Desa</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="namakelurahan" id="namakelurahan" placeholder="Nama kelurahan/ desa">
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm float-right" id="btnSimpan"><i class="fa fa-save mr-1"></i>Simpan</button>
                        <a href="{{ url('kelurahan') }}" class="btn btn-default btn-sm float-right mr-3">Kembali</a>
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
    var kodekelurahan = "{{ $kodekelurahan }}";

    $(document).ready(function() {

        $('.select2').select2();

        if (kodekelurahan != "") {
            $('#kodekelurahan').val(kodekelurahan);
            $('.id-primary').html('ID: ' + kodekelurahan);
            $('.label-judul .label-aksi').html('Edit');

            $.ajax({
                    url: "{{ url('kelurahan/getId') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'kodekelurahan': kodekelurahan
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    addSelectOption('kodekabupaten', response.kodekabupaten, response.kodekabupaten + ' - ' + response.namakabupaten);
                    $('#kodekabupaten').val(response['kodekabupaten']).trigger('change');
                    $('#namakelurahan').val(response['namakelurahan']);
                    $('#tglberdiri').val(response['tglberdiri']);
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
                    kodekabupaten: {
                        validators: {
                            notEmpty: {
                                message: 'kode kabupaten tidak boleh kosong'
                            },
                        }
                    },
                    kodekecamatan: {
                        validators: {
                            notEmpty: {
                                message: 'kode kecamatan tidak boleh kosong'
                            },
                        }
                    },
                    kodekelurahan: {
                        validators: {
                            notEmpty: {
                                message: 'kode kelurahan tidak boleh kosong'
                            },
                            stringLength: {
                                min: 6,
                                max: 6,
                                message: 'minimal 6 karakter'
                            },
                        }
                    },
                    namakelurahan: {
                        validators: {
                            notEmpty: {
                                message: 'nama kelurahan tidak boleh kosong'
                            },
                            stringLength: {
                                max: 100,
                                message: 'maksimal 100 karakter'
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
                    url: "{{ url('kelurahan/simpan') }}",
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
                                window.location.href = "{{ url('kelurahan') }}";
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
        
        
    });

    
</script>

@endsection