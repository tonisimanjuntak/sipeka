@extends('admin/template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">KATEGORI</h1>
    </div>

    <form action="{{ url('admin/kategori/simpan') }}" method="POST" id="form" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="idkategori" id="idkategori">
        <div class="row">
            <!-- Area Chart -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary label-judul"><a href="{{ url('admin/kategori') }}">LIST DATA KATEGORI</a> / <span class="label-aksi"></span> </h6><span class="float-end id-primary"></span>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">                            
                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="namakategori" class="col-md-3 col-form-label">Nama Kategori</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="namakategori" id="namakategori" placeholder="Nama kategori" autofocus>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 required">
                                <div class="form-group row">
                                    <label for="statusaktif" class="col-md-3 col-form-label">Status</label>
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
                        <button type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-save mr-1"></i>Simpan</button>
                        <a href="{{ url('admin/kategori') }}" class="btn btn-default btn-sm float-right mr-3">Kembali</a>
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
    var idkategori = "{{ $idkategori }}";

    $(document).ready(function() {

        $('.select2').select2();

        if (idkategori != "") {
            $('#idkategori').val(idkategori);
            $('.id-primary').html('ID: ' + idkategori);
            $('.label-judul .label-aksi').html('Edit');

            $.ajax({
                    url: "{{ url('admin/kategori/getId') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idkategori': idkategori
                    },
                })
                .done(function(response) {
                    console.log(response);
                    $('#namakategori').val(response['namakategori']);                    
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
                    namakategori: {
                        validators: {
                            notEmpty: {
                                message: 'nama jenis tidak boleh kosong'
                            }
                        }
                    },
                    statusaktif: {
                        validators: {
                            notEmpty: {
                                message: 'status aktif tidak boleh kosong'
                            }
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