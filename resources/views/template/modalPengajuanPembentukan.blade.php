<div class="modal fade" id="modalPengajuanPembentukan" tabindex="-1" aria-labelledby="modalPengajuanPembentukanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPengajuanPembentukanLabel">PEMBENTUKAN KECAMATAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <h3>INFORMASI PENGAJUAN</h3>
                        </div>

                        <div class="col-12 pl-5">
                            <div class="row">

                                <div class="col-12 mt-3">
                                    <label>PENGAJUAN</label>
                                </div>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tableInfoPengajuan">

                                        </table>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <label>PERSYARATAN DASAR</label>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tablePersyaratanDasar">

                                        </table>
                                    </div>
                                </div>


                                <div class="col-12 mt-3">
                                    <label>PERSYARATAN ADMINISTRATIF</label>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tablePersyaratanAdministratif">

                                        </table>
                                    </div>
                                </div>


                                <div class="col-12 mt-3">
                                    <label>PERSYARATAN TEKNIS</label>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tablePersyaratanTeknis">


                                        </table>
                                    </div>
                                </div>


                            </div>

                        </div>


                        <div class="col-12 mt-3">
                            <h3>VERIFIKASI PROPINSI</h3>
                        </div>
                        <div class="col-12 pl-5">
                            <div class="row">

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tableVerifikasiPropinsi">

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <h3>UPLOAD RAPERDA</h3>
                        </div>
                        <div class="col-12 pl-5">
                            <div class="row">

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tableUploadRaperda">

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 mt-3">
                            <h3>TELAAHAN</h3>
                        </div>
                        <div class="col-12 pl-5">
                            <div class="row">

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tableTelaahan">

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 mt-3">
                            <h3>PERMOHONAN KODE</h3>
                        </div>
                        <div class="col-12 pl-5">
                            <div class="row">

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tablePermohonanKode">

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 mt-3">
                            <h3>REKOMENDASI GUBERNUR</h3>
                        </div>
                        <div class="col-12 pl-5">
                            <div class="row">

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tableRekomendasi">

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 mt-3">
                            <h3>KIRIM KE KEMENDAGRI</h3>
                        </div>
                        <div class="col-12 pl-5">
                            <div class="row">

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tableKirimkeKemendagri">

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 mt-3">
                            <h3>SK KEMENDAGRI</h3>
                        </div>
                        <div class="col-12 pl-5">
                            <div class="row">

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-sm table-rapat" id="tableSKKemendagri">

                                        </table>
                                    </div>
                                </div>
                            </div>
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
    $(document).ready(function() {
        
        
        // Event listener untuk saat modal dibuka
        $('#modalPengajuanPembentukan').on('show.bs.modal', function(event) {
            var nopengajuan = $('.btn-detail-pengajuan').attr('data-nopengajuan');

            $.ajax({
                url: "{{ url('pembentukankecamatan/getPengajuanPembentukan') }}",
                type: 'GET',
                dataType: 'json',
                data: {'nopengajuan': nopengajuan},
            })
            .done(function(responsePengajuan) {
                console.log(responsePengajuan);
                var rowInfoPengajuan = responsePengajuan['rsPembentukanKecamatan'];
                var rsDesaTerpilih = responsePengajuan['rsDesaTerpilih'];
                var rsPersyaratanDasar = responsePengajuan['rsPersyaratanDasar'];
                var rsPersyaratanAdministratif = responsePengajuan['rsPersyaratanAdministratif'];
                var rsPersyaratanTeknis = responsePengajuan['rsPersyaratanTeknis'];

                var addText = `
                    <tr>
                        <td style="width: 20%; text-align: left;">No Pengajuan</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.nopengajuan + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Tgl Pengajuan</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.tglpengajuan + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Surat Pengantar</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rowInfoPengajuan.filesuratpengantar + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rowInfoPengajuan.filesuratpengantar + `</a></td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Nama Operator</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.namalengkap + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Kabupaten</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.namakabupaten + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Kecamatan Induk</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.namakecamatan + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Nama Kecamatan Baru</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rsPersyaratanTeknis[0]['namakecamatan'] + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Nama Desa</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">
                `;

                var nodesa = 1;
                for (var i = 0; i < rsDesaTerpilih.length; i++) {
                    if (nodesa > 1) {
                        addText += `<br>`;
                    }
                    addText += nodesa + `. ` + rsDesaTerpilih[i].namakelurahan;
                    nodesa++;
                }
                addText += `</td></tr>`;

                $('#tableInfoPengajuan').html(addText);

                var addText = ``;
                for (var i = 0; i < rsPersyaratanDasar.length; i++) {
                    // console.log(rsPersyaratanDasar[i]);
                    addText += `
                        <tr>
                            <td style="width: 20%; text-align: left;">Jumlah Penduduk</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;">` + rsPersyaratanDasar[i].jumlahpenduduk + `</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">Jumlah KK</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;">` + rsPersyaratanDasar[i].jumlahkk + `</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">Luas Wilayah</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;">` + rsPersyaratanDasar[i].luaswilayah + `</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">Jumlah Kelurahan</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;">` + rsPersyaratanDasar[i].jumlahkelurahan + `</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">File Pendukung</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rsPersyaratanDasar[i].filepersyaratan + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rsPersyaratanDasar[i].filepersyaratan + `</a>  </td>
                        </tr>
                    `;
                }

                $('#tablePersyaratanDasar').html(addText);

                var addText = ``;
                for (var i = 0; i < rsPersyaratanAdministratif.length; i++) {
                    addText += `
                        <tr>
                            <td style="width: 20%; text-align: left;">BA Musyawarah Desa</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rsPersyaratanAdministratif[i].filesuratkesepakatan + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rsPersyaratanAdministratif[i].filesuratkesepakatan + `</a> </td>
                        </tr>
                    `;
                }
                $('#tablePersyaratanAdministratif').html(addText);

                var addText = ``;
                for (var i = 0; i < rsPersyaratanTeknis.length; i++) {
                    addText += `
                        <tr>
                            <td style="width: 20%; text-align: left;">CALK</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rsPersyaratanTeknis[i].filekemampuankeuangan + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rsPersyaratanTeknis[i].filekemampuankeuangan + `</a> </td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">Sarana dan Prasarana</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rsPersyaratanTeknis[i].filesaranadanprasarana + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rsPersyaratanTeknis[i].filesaranadanprasarana + `</a> </td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">Batas Wilayah</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rsPersyaratanTeknis[i].bataswilayah + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rsPersyaratanTeknis[i].bataswilayah + `</a> </td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">Lokasi Calon Ibukota</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rsPersyaratanTeknis[i].lokasicalonibukota + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rsPersyaratanTeknis[i].lokasicalonibukota + `</a></td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">Tata Ruang Wilayah</td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rsPersyaratanTeknis[i].kesesuaiantataruang + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rsPersyaratanTeknis[i].kesesuaiantataruang + `</a></td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: left;">Perbup/ Perwako Tentang Batas Wilayah
                            </td>
                            <td style="width: 5%; text-align: center;">:</td>
                            <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rsPersyaratanTeknis[i].perbupbataswilayah + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rsPersyaratanTeknis[i].perbupbataswilayah + `</a> </td>
                        </tr>
                    `;
                }
                $('#tablePersyaratanTeknis').html(addText);
                
                var addText = `
                    <tr>
                        <td style="width: 20%; text-align: left;">Tgl Verifikasi</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.tglverifikasipropinsi + `</td>
                    </tr>
                `;

                $('#tableVerifikasiPropinsi').html(addText);


                var addText = `
                    <tr>
                        <td style="width: 20%; text-align: left;">Nomor Raperda</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.nomorraperda + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Tgl Raperda</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.tglraperda + `</td>
                    </tr>

                    <tr>
                        <td style="width: 20%; text-align: left;">File Raperda</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rowInfoPengajuan.fileraperda + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rowInfoPengajuan.fileraperda + `</a></td>
                    </tr>
                `;

                $('#tableUploadRaperda').html(addText);


                var addText = `
                    <tr>
                        <td style="width: 20%; text-align: left;">Nomor Register</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.nomorregister + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Tgl Register</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.tglregister + `</td>
                    </tr>

                    <tr>
                        <td style="width: 20%; text-align: left;">Telaahan Hukum</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rowInfoPengajuan.filetelaahanhukum + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rowInfoPengajuan.filetelaahanhukum + `</a></td>
                    </tr>

                    <tr>
                        <td style="width: 20%; text-align: left;">Telaahan Teknis</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rowInfoPengajuan.filetelaahanteknis + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rowInfoPengajuan.filetelaahanteknis + `</a></td>
                    </tr>
                `;
                $('#tableTelaahan').html(addText);


                var addText = `
                    <tr>
                        <td style="width: 20%; text-align: left;">Nomor Permohonan Kode</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.nopermohonankode +`</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Tgl Permohonan Kode</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.tglpermohonankode + `</td>
                    </tr>

                    <tr>
                        <td style="width: 20%; text-align: left;">File Permohonan</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rowInfoPengajuan.filepermohonankode + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rowInfoPengajuan.filepermohonankode + `</a></td></td>
                    </tr>
                `;
                $('#tablePermohonanKode').html(addText);


                var addText = `
                    <tr>
                        <td style="width: 20%; text-align: left;">Nomor Rekomendasi</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.norekomendasigubernur + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">Tgl Rekomendasi</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.tglrekomendasigubernur + `</td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: left;">File Rekomendasi</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rowInfoPengajuan.filerekomendasigubernur + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rowInfoPengajuan.filerekomendasigubernur + `</a></td>
                    </tr>
                `;
                $('#tableRekomendasi').html(addText);

                var addText = `
                    <tr>
                        <td style="width: 20%; text-align: left;">Tanggal Kirim</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.tglkirimsuratkekemendagri +`</td>
                    </tr>
                `;
                $('#tableKirimkeKemendagri').html(addText);


                var addText = `
                    <tr>
                        <td style="width: 20%; text-align: left;">Nomor SK</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.nomorskkemendagri + `</td>
                    </tr>

                    <tr>
                        <td style="width: 20%; text-align: left;">Tanggal SK</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;">` + rowInfoPengajuan.tglskkemendagri + `</td>
                    </tr>

                    <tr>
                        <td style="width: 20%; text-align: left;">File SK</td>
                        <td style="width: 5%; text-align: center;">:</td>
                        <td style="width: 75%; text-align: left;"><a href="{{ asset('uploads/pengajuan') }}/` + rowInfoPengajuan.fileskkemendagri + `" target="_blank"><i class="fa fa-download mr-1"></i>` + rowInfoPengajuan.fileskkemendagri + `</a></td>
                    </tr>
                `;
                $('#tableSKKemendagri').html(addText);

            })
            .fail(function() {
                console.log('error responsePengajuan');
            });
        });
        
        // Event listener untuk saat modal ditutup
        $('#modalPengajuanPembentukan').on('hidden.bs.modal', function() {
            $(this).find('.modal-body').find('td:eq(2)').each(function() {
                $('#tableInfoPengajuan').html('');
                $('#tablePersyaratanDasar').html('');
                $('#tablePersyaratanAdministratif').html('');
                $('#tablePersyaratanTeknis').html('');                
                $('#tableVerifikasiPropinsi').html('');
                $('#tableUploadRaperda').html('');
                $('#tableTelaahan').html('');
                $('#tablePermohonanKode').html('');
                $('#tableRekomendasi').html('');
                $('#tableKirimkeKemendagri').html('');
                $('#tableSKKemendagri').html('');
            });
        });
    });

</script>