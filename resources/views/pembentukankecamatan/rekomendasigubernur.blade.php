@if (session('akseslevel') == 'Admin')

<form action="" method="POST" id="formRekomendasiGubernur" enctype="multipart/form-data">
    <meta name="csrf-token-rekomendasigubernur" content="{{ csrf_token() }}">
    <input type="hidden" name="nopengajuan" id="nopengajuan" value="{{ $nopengajuan }}">

    <div class="card">
        <div class="card-body card-wizard">
            <div class="row">
                <div class="col-12 mb-5">
                    <h5 class="text-primary">REKOMENDASI GUBERNUR <button type="button"
                            class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                            data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="" class="col-md-3">Status Permohonan Kode</label>
                        <div class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio-status-permohonankode" type="radio"
                                    name="statuspermohonankode" id="statuspermohonankode1" value="1" checked>
                                <label class="form-check-label" for="statuspermohonankode1">Setujui dan
                                    Lanjutkan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input radio-status-permohonankode" type="radio"
                                    name="statuspermohonankode" id="statuspermohonankode2" value="2">
                                <label class="form-check-label" for="statuspermohonankode2">Revisi Permohonan
                                    Kode</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="form-group setujui-lanjutkan-permohonankode row">
                        <label for="norekomendasigubernur" class="col-md-3">Nomor Rekomendasi</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="norekomendasigubernur"
                                name="norekomendasigubernur" placeholder="Nomor rekomendasi gubernur">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglrekomendasigubernur" class="col-md-3" id="lbltglrekomendasigubernur">Tanggal
                            Rekomendasi</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="tglrekomendasigubernur"
                                name="tglrekomendasigubernur" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="form-group setujui-lanjutkan-permohonankode row">
                        <label for="" class="col-md-3">Upload File Rekomendasi</label><label class="col-md-9"><input
                                type="file" class="form-control" id="filerekomendasigubernur"
                                name="filerekomendasigubernur"></label>
                    </div>

                </div>

                <div class="col-12 mt-3 deskripsi-revisi-permohonankode" style="display: none;">
                    <div class="form-group row">
                        <label for="" class="col-md-3">Deskripsi Revisi Permohonan Kode</label>
                        <div class="col-md-9">
                            <textarea name="deskripsirevisipermohonankode" id="deskripsirevisipermohonankode"
                                class="form-control" rows="10"
                                placeholder="Deskripsikan apa saja yang perlu direvisi"></textarea>
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
                <h5 class="text-primary">REKOMENDASI GUBERNUR <button type="button"
                        class="btn btn-info btn-sm float-right btn-detail-pengajuan"
                        data-nopengajuan="{{ $nopengajuan }}">Lihat Detail Pengajuan</button></h5>
            </div>

            <div class="col-12 text-center mt-5">
                <h5>Harap Menunggu. Sedang Membuat Rekomendasi Gubernur.</h5>
            </div>

        </div>
    </div>
</div>

@endif