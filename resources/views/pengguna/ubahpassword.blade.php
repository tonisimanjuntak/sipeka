@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PENGGUNA</h1>
    </div>

    <form action="{{ url('pengguna/simpanUbahPassword') }}" method="POST" id="form" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="idpengguna" id="idpengguna">
        <div class="row">
            <!-- Area Chart -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary label-judul"><span class="label-aksi"></span> </h6>
                        <span class="float-end id-primary"></span>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img src="{{ asset('images/users.png') }}" alt="" style="width: 80%;"
                                            id="preview_foto">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <input type="file" name="foto" id="foto" class="form-control">
                                        <input type="hidden" name="foto_lama" id="foto_lama">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="row">

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="nip" class="col-md-3 col-form-label">Operator Kabupaten</label>
                                            <div class="col-md-9">
                                                <select name="kodekabupaten" id="kodekabupaten"
                                                    class="form-control select2" autofocus>
                                                    <option value="">-- Pilih Kabupaten --</option>
                                                    @foreach ($rsKabupaten as $item)
                                                    <option value="{{ $item->kodekabupaten }}">{{ $item->namakabupaten
                                                        }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="nip" class="col-md-3 col-form-label">NIP</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control nip" name="nip" id="nip"
                                                    placeholder="NIP">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="namalengkap" class="col-md-3 col-form-label">Nama
                                                Lengkap</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="namalengkap"
                                                    id="namalengkap" placeholder="Nama lengkap">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="gelardepan" class="col-md-3 col-form-label">Gelar Depan</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="gelardepan"
                                                    id="gelardepan" placeholder="Gelar depan">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="gelarbelakang" class="col-md-3 col-form-label">Gelar
                                                Belakang</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="gelarbelakang"
                                                    id="gelarbelakang" placeholder="Gelar belakang">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="gelarbelakang" class="col-md-3 col-form-label">Pangkat</label>
                                            <div class="col-md-9">
                                                <select name="idpangkat" id="idpangkat" class="form-control select2">
                                                    <option value="">-- Pilih pangkat --</option>
                                                    @foreach ($rsPangkat as $p)
                                                    <option value="{{ $p->idpangkat }}">{{ $p->namapangkat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="jabatan" class="col-md-3 col-form-label">Jabatan</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="jabatan" id="jabatan"
                                                    placeholder="Jabatan">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="nomorwa" class="col-md-3 col-form-label">Nomor Whatsapp</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control nowa" name="nomorwa" id="nomorwa"
                                                    placeholder="Nomor whatsapp">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="email" class="col-md-3 col-form-label">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required" style="display: none;">
                                        <div class="form-group row">
                                            <label for="username" class="col-md-3 col-form-label">Username</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="username" id="username"
                                                    placeholder="Username">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="nomorsk" class="col-md-3 col-form-label">Nomor SK</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="nomorsk" id="nomorsk"
                                                    placeholder="Nomor SK">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="tglsk" class="col-md-3 col-form-label">Tanggal SK</label>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control" name="tglsk" id="tglsk">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="filesk" class="col-md-3 col-form-label">File SK</label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="filesk_lama" id="filesk_lama">
                                                <a href="" target="_blank" id="link_filesk"></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="password" class="col-md-3 col-form-label">Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="*********">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="password2" class="col-md-3 col-form-label">Ulangi
                                                Password</label>
                                            <div class="col-md-9">
                                                <input type="password2" class="form-control" name="password2"
                                                    id="password2" placeholder="*********">
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm float-right" id="btnSimpan"><i
                                class="fa fa-save mr-1"></i>Simpan</button>
                        <a href="{{ url('pengguna') }}" class="btn btn-default btn-sm float-right mr-3">Kembali</a>
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
    var idpengguna = "{{ $idpengguna }}";

    $(document).ready(function() {

        $('.select2').select2();

        $('#idpengguna').val(idpengguna);
        $('.id-primary').html('ID: ' + idpengguna);
        $('.label-judul .label-aksi').html('Edit');

        $.ajax({
                url: "{{ url('pengguna/getId') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    'idpengguna': idpengguna
                },
            })
            .done(function(response) {
                console.log(response);
                $('#namalengkap').val(response['namalengkap']).attr('disabled', true);                    
                $('#kodekabupaten').val(response['kodekabupaten']).trigger('change').attr('disabled', true);                    
                $('#nip').val(response['nip']).attr('disabled', true);                    
                $('#gelarbelakang').val(response['gelarbelakang']).attr('disabled', true);                    
                $('#gelardepan').val(response['gelardepan']).attr('disabled', true);                    
                $('#idpangkat').val(response['idpangkat']).trigger('change').attr('disabled', true);                    
                $('#jabatan').val(response['jabatan']).attr('disabled', true);       
                $('#nomorwa').val(response['nomorwa']).attr('disabled', true);             
                $('#email').val(response['email']).attr('disabled', true);                    
                $('#username').val(response['username']).attr('disabled', true);                                                           
                $('#nomorsk').val(response['nomorsk']).attr('disabled', true);                    
                $('#tglsk').val(response['tglsk']).attr('disabled', true);                    
                $('#filesk_lama').val(response['filesk']).attr('disabled', true);
                $('#foto_lama').val(response['foto']);

                if (response['foto'] != null && response['foto'] != "") {
                    $('#preview_foto').attr('src', "{{ asset('uploads/pengguna/') }}/" + response['foto']);                        
                }

                if (response['filesk'] != null && response['filesk'] != "") {
                    $('#link_filesk').attr('href', "{{ asset('uploads/pengguna/') }}/" + response['filesk']);
                    $('#link_filesk').html(response['filesk']);
                }


            })
            .fail(function() {
                console.log('error getDataID');
            });


        $('#form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    password: {
                        validators: {
                            stringLength: {
                                min: 6,
                                max: 25,
                                message: 'minimal 6 sampai dengan 25 karakter dan '
                            },
                            callback: {
                                message: "Password tidak boleh kosong",
                                callback: function(value, validator, password) {

                                    if (idpengguna == "") {
                                        
                                        if ($('#password').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Password tidak boleh kosong"
                                            }
                                        }
    
                                        
                                    }

                                    if (value != "") {
                                        // Validasi regex untuk password
                                        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
                                        if (!regex.test(value)) {
                                            return {
                                                valid: false,
                                                message: "Password harus mengandung huruf besar, huruf kecil, dan angka"
                                            };
                                        }                                        
                                    }

                                    return true
                                }
                            }
                        }
                    },
                    password2: {
                        validators: {
                            stringLength: {
                                min: 6,
                                max: 25,
                                message: 'minimal 6 sampai dengan 25 karakter dan '
                            },
                            callback: {
                                message: "Password tidak boleh kosong",
                                callback: function(value, validator, password2) {

                                    if (idpengguna == "") {
                                        
                                        if ($('#password2').val() == '') {
                                            return {
                                                valid: false,
                                                message: "UlangiPassword tidak boleh kosong"
                                            }
                                        }
    
                                        
                                    }

                                    if (value != "") {
                                        // Validasi regex untuk password
                                        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
                                        if (!regex.test(value)) {
                                            return {
                                                valid: false,
                                                message: "Password harus mengandung huruf besar, huruf kecil, dan angka"
                                            };
                                        }                                        
                                    }

                                    return true
                                }
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