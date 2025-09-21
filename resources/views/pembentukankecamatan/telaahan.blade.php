@if (session('akseslevel') == 'Admin')
<form action="" method="POST" id="formTelaahan" enctype="multipart/form-data">
    <meta name="csrf-token-telaahan" content="{{ csrf_token() }}">
    <input type="hidden" name="nopengajuan" id="nopengajuan" value="{{ $nopengajuan }}">

    <div class="card">
        <div class="card-body card-wizard">
            <div class="row">
                <div class="col-12 mb-5">
                    <h5 class="text-primary">TELAAHAN HUKUM DAN TEKNIS <button type="button"
                            class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                            data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="" class="col-md-3">Status Ranperda</label>
                        <div class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio-verifikasi-raperda" type="radio"
                                    name="statusraperda" id="statusraperda1" value="1" checked>
                                <label class="form-check-label" for="statusraperda1">Setujui dan
                                    Lanjutkan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio-verifikasi-raperda" type="radio"
                                    name="statusraperda" id="statusraperda2" value="2">
                                <label class="form-check-label" for="statusraperda2">Revisi Ranperda</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="form-group setujui-lanjutkan-raperda row">
                        <label for="nomorregister" class="col-md-3">Nomor Register</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="nomorregister" name="nomorregister"
                                placeholder="Nomor register">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglregister" class="col-md-3" id="lbltglregister">Tanggal Register</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="tglregister" name="tglregister"
                                value="{{ date('Y-m-d') }}">
                        </div>
                    </div>


                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="" class="col-md-3">Telaahan Hukum</label><label class="col-md-9"><input type="file"
                                class="form-control" id="filetelaahanhukum" name="filetelaahanhukum"></label>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-3">Telaahan Teknis</label><label class="col-md-9"><input type="file"
                                class="form-control" id="filetelaahanteknis" name="filetelaahanteknis"></label>
                    </div>
                </div>

                <div class="col-12 mt-3 deskripsi-revisi-raperda" style="display: none;">
                    <div class="form-group row">
                        <label for="" class="col-md-3">Deskripsi Revisi Ranperda</label>
                        <div class="col-md-9">
                            <textarea name="deskripsirevisiraperda" id="deskripsirevisiraperda" class="form-control"
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
                <h5 class="text-primary">TELAAHAN HUKUM DAN TEKNIS <button type="button"
                        class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                        data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
            </div>




            <div class="col-12 text-center mt-5">
                <h5>Harap Menunggu. Sedang Telaahan Hukum dan Teknis.</h5>
            </div>

        </div>
    </div>
</div>

@endif