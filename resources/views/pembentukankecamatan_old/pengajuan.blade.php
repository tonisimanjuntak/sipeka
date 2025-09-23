<form action="{{ url('pembentukankecamatan/simpan') }}" method="POST" id="formPengajuan" enctype="multipart/form-data">
    <meta name="csrf-token-pengajuan" content="{{ csrf_token() }}">
    <div class="card">
        <div class="card-body card-wizard">


            <div class="row">
                <div class="col-12 mb-5">
                    <h5 class="text-primary">PENGAJUAN PEMBENTUKAN KECAMATAN</h5>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="nopengajuan" class="col-md-3">Nomor Pengajuan</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="nopengajuan" name="nopengajuan"
                                placeholder="Nomor pengajuan" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglpengajuan" class="col-md-3">Tanggal Pengajuan</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="tglpengajuan" name="tglpengajuan"
                                value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="filesuratpengantar" class="col-md-3">Surat Pengantar (.pdf)</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control" id="filesuratpengantar" name="filesuratpengantar"
                                accept="application/pdf">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="namakecamatanbaru" class="col-md-3">Nama Kecamatan Baru</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="namakecamatanbaru" name="namakecamatanbaru"
                                placeholder="Nama kecamatan baru">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglpengajuan" class="col-md-3">Kecamatan Induk</label>
                        <div class="col-md-9">
                            <select name="kodekecamatan" id="kodekecamatan"
                                class="form-control searchKecamatan"></select>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>PERSYARATAN DASAR</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 mt-3 mb-3">
                                    <h5>List Desa Yang Masuk Ke Dalam Kecamatan Baru <button type="button"
                                            class="btn btn-primary btn-sm float-right" id="btnTambahKelurahan"><i
                                                class="fa fa-plus mr-1"></i>Tambah Kelurahan/ Desa</button></h5>
                                </div>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="tableDesa">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%; text-align: center;">Kode</th>
                                                    <th style="text-align: center;">Nama Desa</th>
                                                    <th style="width: 15%; text-align: center;">Jumlah Penduduk</th>
                                                    <th style="width: 15%; text-align: center;">Jumlah KK</th>
                                                    <th style="width: 15%; text-align: center;">Luas Wilayah</th>
                                                    <th style="width: 10%; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyDesa">
                                                <tr>
                                                    <td style="width: 100%; text-align: center;" colspan="6">Belum ada
                                                        desa yang
                                                        dipilih...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-md-3" style="display: none">
                                    <div class="form-group">
                                        <label for="">Jumlah Kelurahan</label>
                                        <input type="number" name="jumlahkelurahan" id="jumlahkelurahan"
                                            class="form-control" placeholder="0" readonly>
                                    </div>
                                </div>

                                <div class="col-md-9 mt-3">
                                    <div class="form-group">
                                        <label for="">Upload File Pendukung (.pdf)</label>
                                        <input type="file" name="filepersyaratandasar" id="filepersyaratandasar"
                                            class="form-control" placeholder="0" accept="application/pdf">
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>PERSYARATAN ADMINISTRATIF</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Upload Berita Acara Musyawarah Desa (.pdf)</label>
                                        <input type="file" name="filesuratkesepakatan" id="filesuratkesepakatan"
                                            class="form-control" placeholder="0" accept="application/pdf">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>PERSYARATAN TEKNIS</h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">CALK (.pdf)</label>
                                    <input type="file" name="kemampuankeuangan" id="kemampuankeuangan"
                                        class="form-control" placeholder="0" accept="application/pdf">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Sarana dan Prasarana (.pdf)</label>
                                    <input type="file" name="saranaprasarana" id="saranaprasarana" class="form-control"
                                        placeholder="0" accept="application/pdf">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Batas Wilayah (.shp)</label>
                                    <input type="file" name="bataswilayah" id="bataswilayah" class="form-control"
                                        placeholder="0" accept="application/shp">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Lokasi Calon Ibukota (.pdf)</label>
                                    <input type="file" name="lokasicalonibukota" id="lokasicalonibukota"
                                        class="form-control" placeholder="0" accept="application/pdf">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Tata Ruang Wilayah (.pdf)</label>
                                    <input type="file" name="kesesuaiantataruang" id="kesesuaiantataruang"
                                        class="form-control" placeholder="0" accept="application/pdf">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Perbup/ Perwako Tentang Batas Wilayah (.pdf)</label>
                                    <input type="file" name="perbupbataswilayah" id="perbupbataswilayah"
                                        class="form-control" placeholder="0" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm float-right" id="btnSimpan"><i
                    class="fa fa-save mr-1"></i>Simpan dan Lanjutkan</button>
        </div>
    </div>
</form>