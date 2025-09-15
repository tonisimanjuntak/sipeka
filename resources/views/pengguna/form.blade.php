@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PENGGUNA</h1>
    </div>

    <form action="{{ url('pengguna/simpan') }}" method="POST" id="form" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="idpengguna" id="idpengguna">
        <div class="row">
            <!-- Area Chart -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary label-judul"><a href="{{ url('pengguna') }}">LIST DATA PENGGUNA</a> / <span class="label-aksi"></span> </h6><span class="float-end id-primary"></span>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">                            
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img src="{{ asset('images/users.png') }}" alt="" style="width: 80%;" id="preview_foto">
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
                                                <select name="kodekabupaten" id="kodekabupaten" class="form-control select2" autofocus>
                                                    <option value="">-- Pilih Kabupaten --</option>
                                                    @foreach ($rsKabupaten as $item)
                                                        <option value="{{ $item->kodekabupaten }}">{{ $item->namakabupaten }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="nip" class="col-md-3 col-form-label">NIP</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control nip" name="nip" id="nip" placeholder="NIP">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="namalengkap" class="col-md-3 col-form-label">Nama Lengkap</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="namalengkap" id="namalengkap" placeholder="Nama lengkap">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="gelardepan" class="col-md-3 col-form-label">Gelar Depan</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="gelardepan" id="gelardepan" placeholder="Gelar depan">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="gelarbelakang" class="col-md-3 col-form-label">Gelar Belakang</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="gelarbelakang" id="gelarbelakang" placeholder="Gelar belakang">
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
                                                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="nomorwa" class="col-md-3 col-form-label">Nomor Whatsapp</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control nowa" name="nomorwa" id="nomorwa" placeholder="Nomor whatsapp">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="email" class="col-md-3 col-form-label">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required" style="display: none;">
                                        <div class="form-group row">
                                            <label for="username" class="col-md-3 col-form-label">Username</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required" id="divpassword">
                                        <div class="form-group row">
                                            <label for="password" class="col-md-3 col-form-label">Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="*********">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 required">
                                        <div class="form-group row">
                                            <label for="nomorsk" class="col-md-3 col-form-label">Nomor SK</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="nomorsk" id="nomorsk" placeholder="Nomor SK">
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
                                                <input type="file" name="filesk" id="filesk" class="form-control">
                                                <input type="hidden" name="filesk_lama" id="filesk_lama">
                                                <a href="" target="_blank" id="link_filesk"></a>
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
                            

                            
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm float-right" id="btnSimpan"><i class="fa fa-save mr-1"></i>Simpan</button>
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

        if (idpengguna != "") {
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
                    $('#namalengkap').val(response['namalengkap']);                    
                    $('#kodekabupaten').val(response['kodekabupaten']).trigger('change');                    
                    $('#nip').val(response['nip']);                    
                    $('#gelarbelakang').val(response['gelarbelakang']);                    
                    $('#gelardepan').val(response['gelardepan']);                    
                    $('#idpangkat').val(response['idpangkat']).trigger('change');                    
                    $('#jabatan').val(response['jabatan']);       
                    $('#nomorwa').val(response['nomorwa']);             
                    $('#email').val(response['email']);                    
                    $('#username').val(response['username']);                                                           
                    $('#nomorsk').val(response['nomorsk']);                    
                    $('#tglsk').val(response['tglsk']);                    
                    $('#filesk_lama').val(response['filesk']);
                    $('#foto_lama').val(response['foto']);

                    if (response['foto'] != null && response['foto'] != "") {
                        $('#preview_foto').attr('src', "{{ asset('uploads/pengguna/') }}/" + response['foto']);                        
                    }

                    if (response['filesk'] != null && response['filesk'] != "") {
                        $('#link_filesk').attr('href', "{{ asset('uploads/pengguna/') }}/" + response['filesk']);
                        $('#link_filesk').html(response['filesk']);
                    }

                    $('#statusaktif').val(response['statusaktif']).trigger('change');   
                    $('#divpassword').hide();
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
                                message: 'nama kabupaten tidak boleh kosong'
                            },
                        }
                    },
                    nip: {
                        validators: {
                            notEmpty: {
                                message: 'nip tidak boleh kosong'
                            },
                            stringLength: {
                                min: 18,
                                max: 18,
                                message: 'NIP harus 18 karakter'
                            },
                        }
                    },
                    namalengkap: {
                        validators: {
                            notEmpty: {
                                message: 'nama tidak boleh kosong'
                            },
                            stringLength: {
                                max: 100,
                                message: 'maksimal 100 karakter'
                            },
                        }
                    },
                    idpangkat: {
                        validators: {
                            notEmpty: {
                                message: 'pangkat tidak boleh kosong'
                            }
                        }
                    },
                    jabatan: {
                        validators: {
                            notEmpty: {
                                message: 'jabatan tidak boleh kosong'
                            },
                            stringLength: {
                                max: 255,
                                message: 'maksimal 255 karakter'
                            },
                        }
                    },
                    nomorwa: {
                        validators: {
                            notEmpty: {
                                message: 'nomor whatsapp tidak boleh kosong'
                            },
                            stringLength: {
                                max: 25,
                                message: 'maksimal 25 karakter'
                            },
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'email tidak boleh kosong'
                            },
                            stringLength: {
                                max: 50,
                                message: 'maksimal 50 karakter'
                            },
                        }
                    },
                    // username: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'username tidak boleh kosong'
                    //         },
                    //         stringLength: {
                    //             min: 5,
                    //             max: 50,
                    //             message: 'username minimal 6 karakter dan maksimal 50 karakter'
                    //         },
                    //         regexp: {
                    //             regexp: /^[A-Za-z0-9_-]+$/, // Hanya huruf besar dan kecil, tanpa spasi
                    //             message: ' Hanya karakter alphanumeric yang diperbolehkan (tanpa spasi)'
                    //         }
                    //     }
                    // },
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
                    nomorsk: {
                        validators: {
                            notEmpty: {
                                message: 'nomor SK tidak boleh kosong'
                            },
                            stringLength: {
                                max: 50,
                                message: 'maksimal 50 karakter'
                            },
                        }
                    },
                    tglsk: {
                        validators: {
                            notEmpty: {
                                message: 'tanggal SK tidak boleh kosong'
                            }
                        }
                    },
                    filesk: {
                        validators: {
                            callback: {
                                message: "file sk tidak boleh kosong",
                                callback: function(value, validator, filesk) {

                                    if (idpengguna == "") {
                                        
                                        if ($('#filesk').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Password tidak boleh kosong"
                                            }
                                        }
                                        
                                    }

                                    return true
                                }
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