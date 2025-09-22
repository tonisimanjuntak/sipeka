@if (session('akseslevel') == 'Admin')

<form action="" method="POST" id="fromSkKemendagri" enctype="multipart/form-data">
    <meta name="csrf-token-skkemendagri" content="{{ csrf_token() }}">
    <input type="hidden" name="nopengajuan" id="nopengajuan" value="{{ $nopengajuan }}">

    <div class="card">
        <div class="card-body card-wizard">
            <div class="row">
                <div class="col-12 mb-5">
                    <h5 class="text-primary">SK KEMENDAGRI <button type="button"
                            class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                            data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="nomorskkemendagri" class="col-md-3">Nomor SK</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="nomorskkemendagri" name="nomorskkemendagri"
                                placeholder="Nomor SK Kemendagri">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglskkemendagri" class="col-md-3">Tanggal SK</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="tglskkemendagri" name="tglskkemendagri"
                                value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-3">Upload File SK</label><label class="col-md-9"><input type="file"
                                class="form-control" id="fileskkemendagri" name="fileskkemendagri"></label>
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
                <h5 class="text-primary">SK KEMENDAGRI <button type="button"
                        class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                        data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
            </div>

            <div class="col-12 text-center mt-5">
                <h5>Menunggu SK dari Kemendagri.</h5>
            </div>

        </div>
    </div>
</div>


@endif