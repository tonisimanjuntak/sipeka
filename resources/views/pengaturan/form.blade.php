@extends('admin/template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PENGATURAN</h1>
    </div>

    <form action="{{ url('admin/pengaturan/simpan') }}" method="POST" id="form" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Area Chart -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary label-judul"><a href="{{ url('admin/pengaturan') }}">LIST DATA PENGATURAN</a> / <span class="label-aksi"></span> </h6><span class="float-end id-primary"></span>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">

                        <input type="hidden" name="ltambah" value="{{ $ltambah }}">
                        <div class="row">
                            <div class="col-md-12 required">
                                <div class="form-group">
                                    <label for="prefix">Prefix</label>
                                    <input type="text" name="prefix" id="prefix"
                                        class="form-control" placeholder="Prefix" autofocus>
                                </div>
                            </div>
                            <div class="col-md-12 required">
                                <div class="form-group">
                                    <label for="values">Values</label>
                                    <textarea name="values" id="values" class="form-control" placeholder="values" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-save mr-1"></i>Simpan</button>
                        <a href="{{ url('admin/pengaturan') }}" class="btn btn-default btn-sm float-right mr-3">Kembali</a>
                    </div>
                </div>
            </div>


        </div>
    </form>


</div>
<!-- /.container-fluid -->
    
@endsection


@section('javascript')
    
<script>
    var prefix = "{{ $prefix }}";

    $(document).ready(function() {

        $('.select2').select2();

        if (prefix != "") {
            $('#prefix').val(prefix);
            $('.id-primary').html('ID: ' + prefix);
            $('.label-judul .label-aksi').html('Edit');

            $.ajax({
                    url: "{{ url('admin/pengaturan/getId') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'prefix': prefix
                    },
                })
                .done(function(response) {
                    console.log(response);
                    $('#prefix').attr('readonly', true);
                    $('#values').val(response['values']);
                    $('#deskripsi').val(response['deskripsi']);
                    $('#values').focus();

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
                prefix: {
                    validators: {
                        notEmpty: {
                            message: 'prefix tidak boleh kosong'
                        },
                        stringLength: {
                            max: 50,
                            message: 'maksimal 50 karakter'
                        },
                        regexp: {
                            regexp: /^[A-Za-z0-9_-]+$/, // Hanya huruf besar dan kecil, tanpa spasi
                            message: 'Hanya karakter alphanumeric yang diperbolehkan (tanpa spasi)'
                        },
                    }
                },
                values: {
                    validators: {
                        notEmpty: {
                            message: 'value tidak boleh kosong'
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