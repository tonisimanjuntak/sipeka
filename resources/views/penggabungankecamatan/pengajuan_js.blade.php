<script>
    $('#formPengajuan').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            tglpengajuan: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal pengajuan tidak boleh kosong'
                    }
                }
            },
            kodekecamatan: {
                validators: {
                    notEmpty: {
                        message: 'Nama kecamatan tidak boleh kosong'
                    }
                }
            },
            filesuratpengantar: {
                validators: {
                    notEmpty: {
                        message: 'File surat pengantar tidak boleh kosong'
                    }
                }
            },
            jumlahpenduduk: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah penduduk tidak boleh kosong'
                    }
                }
            },
            jumlahkk: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah kk tidak boleh kosong'
                    }
                }
            },
            luaswilayah: {
                validators: {
                    notEmpty: {
                        message: 'Luas wilayah tidak boleh kosong'
                    }
                }
            },
            jumlahkelurahan: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah desa/kelurahan tidak boleh kosong'
                    }
                }
            },
            filepersyaratandasar: {
                validators: {
                    notEmpty: {
                        message: 'File persyaratan tidak boleh kosong'
                    }
                }
            },
            filesuratkesepakatan: {
                validators: {
                    notEmpty: {
                        message: 'File surat kesepakatan tidak boleh kosong'
                    }
                }
            },
            kemampuankeuangan: {
                validators: {
                    notEmpty: {
                        message: 'File kemampuan keuangan tidak boleh kosong'
                    }
                }
            },
            saranadanprasarana: {
                validators: {
                    notEmpty: {
                        message: 'File surat kesepakatan tidak boleh kosong'
                    }
                }
            },
            bataswilayah: {
                validators: {
                    notEmpty: {
                        message: 'File batas wilayah tidak boleh kosong'
                    }
                }
            },
            lokasicalonibukota: {
                validators: {
                    notEmpty: {
                        message: 'File lokasi calon ibukota tidak boleh kosong'
                    }
                }
            },   
            kesesuaiantataruang: {
                validators: {
                    notEmpty: {
                        message: 'File kesesuaian tata ruang tidak boleh kosong'
                    }
                }
            },
            perbupbataswilayah: {
                validators: {
                    notEmpty: {
                        message: 'File perbup/ perwako tentang batas wilayah tidak boleh kosong'
                    }
                }
            },            
        }
    })
    .on('success.form.bv', function(e) {
        e.preventDefault(); // Cegah submit default

        const $form = $(e.target);
        const formData = new FormData($form[0]); // Ambil semua input, termasuk file

        $('#btnSimpan').prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');

        // Kirim via AJAX
        $.ajax({
            url: "{{ url('pembentukankecamatan/simpanPengajuan') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token-pengajuan"]').attr('content')
            },
            success: function(response) {                
                console.log(response);

                if (response.success) {
                    swal('Berhasil!', 'Data berhasil disimpan.', 'success')
                    .then(() => {
                        window.location.href = "{{ url('pembentukankecamatan') }}" + "/progress/" + response['nopengajuan'];
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
    });

    function simpanPengajuan() {
        const $form = $('#formPengajuan');
        const formData = new FormData($form[0]); // Ambil semua input, termasuk file

        
    }

    $(document).on('change', '#kodekecamatan', function() {
        $('#tbodyDesa').html(`<tr>
                                    <td style="width: 100%; text-align: center;" colspan="4">Belum ada desa yang
                                        dipilih...</td>
                                </tr>`);
    });


    $(document).on('click', '#btnTambahKelurahan', function() {
        loadModalPilihKelurahan();
    });

    $(document).on('click', '.btn-hapus-kelurahan', function() {
        $(this).closest('tr').remove();
    });
</script>