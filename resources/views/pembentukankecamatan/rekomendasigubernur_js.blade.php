<script>
    $(document).ready(function () {

        $(document).on('change', '.radio-status-permohonankode', function() {
            console.log($(this).val());
            if ($(this).val() == '2') {
                $('.deskripsi-revisi-permohonankode').show();
                $('.setujui-lanjutkan-permohonankode').hide();
            } else {
                $('.deskripsi-revisi-permohonankode').hide();
                $('.setujui-lanjutkan-permohonankode').show();
            }
        });
        
        $('#formRekomendasiGubernur').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                norekomendasigubernur: {
                    validators: {
                        callback: {
                                message: "Nomor rekomendasi tidak boleh kosong",
                                callback: function(value, validator, norekomendasigubernur) {

                                    if ($('input[name="statuspermohonankode"]:checked').val() == '1') {
                                        
                                        if ($('#norekomendasigubernur').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Nomor rekomendasi tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                    }
                },
                tglrekomendasigubernur: {
                    validators: {
                        callback: {
                                message: "Tanggal rekomendasi tidak boleh kosong",
                                callback: function(value, validator, tglrekomendasigubernur) {

                                    if ($('input[name="statuspermohonankode"]:checked').val() == '1') {
                                        
                                        if ($('#tglrekomendasigubernur').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Tanggal rekomendasi tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                    }
                },
                filerekomendasigubernur: {
                    validators: {
                        callback: {
                                message: "File rekomendasi tidak boleh kosong",
                                callback: function(value, validator, filerekomendasigubernur) {

                                    if ($('input[name="statuspermohonankode"]:checked').val() == '1') {
                                        
                                        if ($('#filerekomendasigubernur').val() == '') {
                                            return {
                                                valid: false,
                                                message: "File rekomendasi tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                    }
                },
                deskripsirevisipermohonankode: {
                    validators: {
                        callback: {
                                message: "Deskripsi revisi raperda teknis tidak boleh kosong",
                                callback: function(value, validator, deskripsirevisipermohonankode) {

                                    if ($('input[name="statuspermohonankode"]:checked').val() == '2') {
                                        
                                        if ($('#deskripsirevisipermohonankode').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Deskripsi revisi permhonankode tidak boleh kosong"
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
                url: "{{ url('pembentukankecamatan/simpanRekomendasiGubernur') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-rekomendasigubernur"]').attr('content')
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

    });
</script>