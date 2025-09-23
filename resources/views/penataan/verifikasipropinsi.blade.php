@if (session('akseslevel') == 'Admin')
<form action="" method="POST" id="formVerifikasiPropinsi">
    <meta name="csrf-token-verifikasipropinsi" content="{{ csrf_token() }}">
    <input type="hidden" name="nopengajuan" id="nopengajuan" value="{{ $nopengajuan }}">
    <div class="card">
        <div class="card-body card-wizard">
            <div class="row">
                <div class="col-12 mb-5">
                    <h5 class="text-primary">VERIFIKASI PROVINSI KECAMATAN <button type="button"
                            class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                            data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button>
                    </h5>
                </div>


                <div class="col-12">
                    <div class="form-group row">
                        <label for="tglverifikasipropinsi" class="col-md-3">Tanggal Verifikasi</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="tglverifikasipropinsi"
                                name="tglverifikasipropinsi" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="" class="col-md-3">Hasil Verifikasi</label>
                        <div class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio-verifikasi-propinsi" type="radio"
                                    name="statusverifikasipropinsi" id="statusverifikasipropinsi1" value="1" checked>
                                <label class="form-check-label" for="statusverifikasipropinsi1">Memenuhi Syarat</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio-verifikasi-propinsi" type="radio"
                                    name="statusverifikasipropinsi" id="statusverifikasipropinsi2" value="2">
                                <label class="form-check-label" for="statusverifikasipropinsi2">Tidak Memenuhi
                                    Syarat/ Revisi</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3 deskripsi-revisi-propinsi" style="display: none;">
                    <div class="form-group row">
                        <label for="" class="col-md-3">Deskripsi Revisi</label>
                        <div class="col-md-9">
                            <textarea name="deskripsirevisipropinsi" id="deskripsirevisipropinsi" class="form-control"
                                rows="10" placeholder="Deskripsikan apa saja yang perlu direvisi"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary btn-sm float-right" id="btnSimpan"><i class="fa fa-save mr-1"></i>Simpan dan
                Lanjutkan</button>
        </div>
    </div>

</form>
@else

<div class="card">
    <div class="card-body card-wizard">
        <div class="row">
            <div class="col-12 mb-5">
                <h5 class="text-primary">VERIFIKASI PROVINSI KECAMATAN <button type="button"
                        class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                        data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button>
                </h5>
            </div>


            <div class="col-12 text-center mt-5">
                <h5>Harap Menunggu. Sedang Diverifikasi di Provinsi</h5>
            </div>

        </div>
    </div>
</div>
@endif