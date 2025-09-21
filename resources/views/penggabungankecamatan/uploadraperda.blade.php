@if (session('akseslevel') == 'Operator Kabupaten')

<form action="" method="POST" id="formUploadRaperda" enctype="multipart/form-data">
    <meta name="csrf-token-uploadraperda" content="{{ csrf_token() }}">
    <input type="hidden" name="nopengajuan" id="nopengajuan" value="{{ $nopengajuan }}">

    <div class="card">
        <div class="card-body card-wizard">
            <div class="row">
                <div class="col-12 mb-5">
                    <h5 class="text-primary">UPLOAD RAPERDA <button type="button"
                            class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                            data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
                </div>

                <div class="col-12">

                    <div class="form-group row">
                        <label for="nomorraperda" class="col-md-3">Nomor Raperda</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="nomorraperda" name="nomorraperda"
                                placeholder="Nomor Raperda">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglraperda" class="col-md-3">Tanggal Raperda</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="tglraperda" name="tglraperda"
                                value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-3">File Raperda</label><label class="col-md-9"><input type="file"
                                class="form-control" id="fileraperda" name="fileraperda"></label>
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
                <h5 class="text-primary">UPLOAD RAPERDA <button type="button"
                        class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                        data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
            </div>

            <div class="col-12 text-center mt-5">
                <h5>Harap Menunggu. Kabupaten Sedang Progres Upload Raperda</h5>
            </div>

        </div>
    </div>
</div>

@endif