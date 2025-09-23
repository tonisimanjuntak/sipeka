<script>
    $(document).ready(function () {

        $('#formKirimKekemendagri').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                tglkirimsuratkekemendagri: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal kirim surat tidak boleh kosong'
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
                url: "{{ url('penataan/simpanKirimSuratKeKemendagri') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-kirimkekemendagri"]').attr('content')
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