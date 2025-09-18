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
        
    });
</script>