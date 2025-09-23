@if (session('akseslevel') == 'Admin')

<form action="" method="POST" id="formKirimKekemendagri" enctype="multipart/form-data">
    <meta name="csrf-token-kirimkekemendagri" content="{{ csrf_token() }}">
    <input type="hidden" name="nopengajuan" id="nopengajuan" value="{{ $nopengajuan }}">

    <div class="card">
        <div class="card-body card-wizard">
            <div class="row">
                <div class="col-12 mb-5">
                    <h5 class="text-primary">KIRIM SURAT KE KEMENDAGRI <button type="button"
                            class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                            data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
                </div>

                <div class="col-12">

                    <div class="form-group row">
                        <label for="tglkirimsuratkekemendagri" class="col-md-3">Tanggal Pengiriman</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="tglkirimsuratkekemendagri"
                                name="tglkirimsuratkekemendagri" value="{{ date('Y-m-d') }}">
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
                <h5 class="text-primary">KIRIM SURAT KE KEMENDAGRI <button type="button"
                        class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                        data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
            </div>


            <div class="col-12 text-center mt-5">
                <h5>Harap Menunggu. Sedang Mengirim Surat Ke Kemendagri.</h5>
            </div>

        </div>
    </div>

</div>

@endif