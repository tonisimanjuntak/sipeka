<div class="modal fade" id="modalPilihKelurahan" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalPilihKelurahanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPilihKelurahanLabel">Pilih Kelurahan / Desa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-sm" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th style="width: 15%; text-align: center;">KODE</th>
                                        <th style="text-align: center;">NAMA KELURAHAN</th>
                                        <th style="width: 15%; text-align: center;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyPilihKelurahan">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function loadModalPilihKelurahan() {
        var kodekecamatan = $('#kodekecamatan').val();

        if (kodekecamatan == '' || kodekecamatan == null) {
            swal("Informasi!", "Pilih Kecamatan terlebih dahulu!", "info");
            return false;
        }

        $('#modalPilihKelurahan').modal('show');
        $('#tbodyPilihKelurahan').html(`<tr>
                                        <td colspan="3" style="text-align: center;">Loading . . .</td>
                                    </tr>`);
        

        $.ajax({
            url: "{{ url('penataan/getKelurahan') }}",
            type: 'GET',
            dataType: 'json',
            data: {'kodekecamatan': kodekecamatan},
        })
        .done(function(response) {
            if (response.length == 0) {
                $('#tbodyPilihKelurahan').html(`<tr>
                                                <td colspan="3" style="text-align: center;">Data tidak ditemukan!</td>
                                            </tr>`);
            }else{
                $('#tbodyPilihKelurahan').html('');

                var tableDesa = [];
                $("#tableDesa tbody tr").each(function() {
                    var rowData = [];
                    $(this).find("td").not(":last").each(function() {
                        rowData.push($(this).text());
                    });
                    tableDesa.push(rowData);
                });

                console.log(tableDesa);


                for (let i = 0; i < response.length; i++) {

                    const sudahAda = tableDesa.some(row => row[0] === response[i].kodekelurahan);

                    if (!sudahAda) {
                        $('#tbodyPilihKelurahan').append(`
                            <tr>
                                <td style="text-align: center;">${response[i].kodekelurahan}</td>
                                <td>${response[i].namakelurahan}</td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-sm btn-primary btn-pilih-kelurahan"><i class="fa fa-check mr-1"></i>Pilih</button>
                                </td>
                            </tr>
                        `);
                    }
                }
            }
            
        })
        .fail(function() {
            console.log('error getKelurahan');
        });
    }

    $(document).on('click', '.btn-pilih-kelurahan', function() {
        var kodekelurahan = $(this).closest('tr').find('td').eq(0).text();
        var namakelurahan = $(this).closest('tr').find('td').eq(1).text();
        $(this).closest("tr").remove();

        var jumlahRow = $("#tableDesa tbody tr").length;
        // console.log("jumlahrow" + jumlahRow);
        if (jumlahRow == 1 && $('#tbodyDesa tr').find('td').eq(1).text() == '') {
            $('#tbodyDesa').html('');
        }        

        $('#tbodyDesa').append(`
            <tr>
                <td style="text-align: center;">
                        ${kodekelurahan}
                        <input type="hidden" name="kodekelurahan[]" value="${kodekelurahan}">
                </td>
                <td>${namakelurahan}</td>
                <td><input type="number" class="jumlahpenduduk" name="jumlahpenduduk[]" value="" placeholder="Jumlah penduduk"></td>
                <td><input type="number" class="jumlahkk" name="jumlahkk[]" value="" placeholder="Jumlah kk"></td>
                <td><input type="text" class="luaswilayah" name="luaswilayah[]" value="" placeholder="Luas Wilayah"></td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-danger btn-hapus-kelurahan"><i class="fa fa-trash mr-1"></i>Hapus</button>
                </td>
            </tr>
        `);
    });
</script>