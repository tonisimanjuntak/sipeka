<script>
    $(document).ready(function () {

        $(document).on('change', '.radio-verifikasi-raperda', function() {
            console.log($(this).val());
            if ($(this).val() == '2') {
                $('.deskripsi-revisi-raperda').show();
                $('.setujui-lanjutkan-raperda').hide();
                $('#lbltglregister').html('Tanggal Revisi')
            } else {
                $('.deskripsi-revisi-raperda').hide();
                $('.setujui-lanjutkan-raperda').show();
                $('#lbltglregister').html('Tanggal Register')
            }
        });
        
        $('#formTelaahan').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nomorregister: {
                    validators: {
                        callback: {
                                message: "Nomor register tidak boleh kosong",
                                callback: function(value, validator, nomorregister) {

                                    if ($('input[name="statusraperda"]:checked').val() == '1') {
                                        
                                        if ($('#nomorregister').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Nomor register tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                    }
                },
                tglregister: {
                    validators: {
                        callback: {
                                message: "Tanggal register tidak boleh kosong",
                                callback: function(value, validator, tglregister) {

                                    if ($('input[name="statusraperda"]:checked').val() == '1') {
                                        
                                        if ($('#tglregister').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Tanggal register tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                    }
                },
                filetelaahanhukum: {
                    validators: {
                        notEmpty: {
                            message: 'File tlaahan hukum tidak boleh kosong'
                        }
                    }
                },
                filetelaahanteknis: {
                    validators: {
                        notEmpty: {
                            message: 'File tlaahan teknis tidak boleh kosong'
                        }
                    }
                },
                deskripsirevisiraperda: {
                    validators: {
                        callback: {
                                message: "Deskripsi revisi raperda teknis tidak boleh kosong",
                                callback: function(value, validator, deskripsirevisiraperda) {

                                    if ($('input[name="statusraperda"]:checked').val() == '2') {
                                        
                                        if ($('#deskripsirevisiraperda').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Deskripsi revisi raperda tidak boleh kosong"
                                            }
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
            e.preventDefault(); // Cegah submit default

            const $form = $(e.target);
            const formData = new FormData($form[0]); // Ambil semua input, termasuk file

            $('#btnSimpan').prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');

            // Kirim via AJAX
            $.ajax({
                url: "{{ url('penataan/simpanTelaahan') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-telaahan"]').attr('content')
                },
                success: function(response) {                
                    console.log(response);

                    if (response.success) {
                        swal('Berhasil!', 'Data berhasil disimpan.', 'success')
                        .then(() => {
                            window.location.href = "{{ url('penataan') }}" + "/progress/" + response['nopengajuan'];
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

    });
</script>