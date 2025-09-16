@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">KABUPATEN</h1>
    </div>

    <form action="{{ url('kabupaten/simpan') }}" method="POST" id="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ltambah" id="ltambah" value="{{ $ltambah }}">
        <div class="row">
            <!-- Area Chart -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary label-judul"><a href="{{ url('kabupaten') }}">LIST DATA KABUPATEN</a> / <span class="label-aksi"></span> </h6><span class="float-end id-primary"></span>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">                            
                            
                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="kodekabupaten" class="col-md-3 col-form-label">Kode Kabupaten</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control kode-kabupaten" name="kodekabupaten" id="kodekabupaten" placeholder="Kode Kabupaten" autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="namakabupaten" class="col-md-3 col-form-label">Nama Kabupaten</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="namakabupaten" id="namakabupaten" placeholder="Nama kabupaten">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm float-right" id="btnSimpan"><i class="fa fa-save mr-1"></i>Simpan</button>
                        <a href="{{ url('kabupaten') }}" class="btn btn-default btn-sm float-right mr-3">Kembali</a>
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
    var kodekabupaten = "{{ $kodekabupaten }}";

    $(document).ready(function() {

        $('.select2').select2();

        if (kodekabupaten != "") {
            $('#kodekabupaten').val(kodekabupaten);
            $('.id-primary').html('ID: ' + kodekabupaten);
            $('.label-judul .label-aksi').html('Edit');

            $.ajax({
                    url: "{{ url('kabupaten/getId') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'kodekabupaten': kodekabupaten
                    },
                })
                .done(function(response) {
                    console.log(response);
                    $('#namakabupaten').val(response['namakabupaten']);
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
                            stringLength: {
                                min: 4,
                                max: 4,
                                message: 'minimal 4 karakter'
                            },
                        }
                    },
                    namakabupaten: {
                        validators: {
                            notEmpty: {
                                message: 'nama kabupaten tidak boleh kosong'
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
                $('#btnSimpan').attr("disabled", true);
            });

        $("form").attr('autocomplete', 'off');

    });

    
</script>

@endsection