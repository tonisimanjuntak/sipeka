<script>
    $(document).ready(function () {
        
        $(document).on('change', '.radio-verifikasi-propinsi', function() {
            console.log($(this).val());
            if ($(this).val() == '2') {
                $('.deskripsi-revisi-propinsi').show();
            } else {
                $('.deskripsi-revisi-propinsi').hide();
            }
        });
        

        $('#formVerifikasiPropinsi').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                tglverifikasipropinsi: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal tidak boleh kosong'
                        }
                    }
                },
                deskripsirevisipropinsi: {
                    validators: {
                        callback: {
                                message: "Deskripsi tidak boleh kosong",
                                callback: function(value, validator, deskripsirevisipropinsi) {

                                    if ($('input[name="statusverifikasipropinsi"]:checked').val() == '2') {
                                        
                                        if ($('#deskripsirevisipropinsi').val() == '') {
                                            return {
                                                valid: false,
                                                message: "Deskripsi tidak boleh kosong"
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
                url: "{{ url('penataan/simpanVerifikasiPropinsi') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-verifikasipropinsi"]').attr('content')
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