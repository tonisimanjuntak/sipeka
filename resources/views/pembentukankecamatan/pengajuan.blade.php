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
                        <input type="text" class="form-control" id="nopengajuan" name="nopengajuan" placeholder="Nomor pengajuan" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tglpengajuan" class="col-md-3">Tanggal Pengajuan</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="tglpengajuan" name="tglpengajuan" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="filesuratpengantar" class="col-md-3">Surat Pengantar</label>
                    <div class="col-md-9">
                        <input type="file" class="form-control" id="filesuratpengantar" name="filesuratpengantar">
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5 mb-3">
                <div class="font-weight-bold">
                    <li>PERSYARATAN DASAR</li>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Jumlah Penduduk</label>
                    <input type="number" name="jumlahpenduduk" id="jumlahpenduduk" class="form-control" placeholder="0">
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Jumlah KK</label>
                    <input type="number" name="jumlahkk" id="jumlahkk" class="form-control" placeholder="0">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Luas Wilayah</label>
                    <input type="text" name="luaswilayah" id="luaswilayah" class="form-control" placeholder="0">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Jumlah Kelurahan</label>
                    <input type="number" name="jumlahkelurahan" id="jumlahkelurahan" class="form-control" placeholder="0">
                </div>
            </div>
    
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Upload File Pendukung</label>
                    <input type="file" name="filepersyaratan" id="filepersyaratan" class="form-control" placeholder="0">
                </div>
                
            </div>
    
    
            <div class="col-12 mt-5 mb-3">
                <div class="font-weight-bold">
                    <li>PERSYARATAN ADMINISTRATIF</li>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Upload Surat Kesepakatan Bersama</label>
                    <input type="file" name="filesuratkesepakatan" id="filesuratkesepakatan" class="form-control" placeholder="0">
                </div>
            </div>

            <div class="col-12 mt-5 mb-3">
                <div class="font-weight-bold">
                    <li>PERSYARATAN TEKNIS</li>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Kemampuan Keuangan</label>
                    <input type="file" name="kemampuankeuangan" id="kemampuankeuangan" class="form-control" placeholder="0">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Sarana dan Prasarana</label>
                    <input type="file" name="saranaprasarana" id="saranaprasarana" class="form-control" placeholder="0">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Batas Wilayah</label>
                    <input type="file" name="bataswilayah" id="bataswilayah" class="form-control" placeholder="0">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Lokasi Calon Ibukota</label>
                    <input type="file" name="lokasicalonibukota" id="lokasicalonibukota" class="form-control" placeholder="0">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Nama Kecamatan</label>
                    <input type="file" name="namakecamatan" id="namakecamatan" class="form-control" placeholder="0">
                </div>
            </div>

        </div>

    </div>
</div>