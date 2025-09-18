<div class="card">
    <div class="card-body card-wizard">
        <div class="row">
            <div class="col-12 mb-5">
                <h5 class="text-primary">VERIFIKASI PROPINSI KECAMATAN</h5>
            </div>

            <div class="col-12">
                <div class="form-group row">
                    <label for="tglverifikasipropinsi" class="col-md-3">Tanggal Verifikasi</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="tglverifikasipropinsi" name="tglverifikasipropinsi" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group row">
                    <label for="" class="col-md-3">Hasil Verifikasi</label>
                    <div class="col-md-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input radio-verifikasi-propinsi" type="radio" name="statusverifikasipropinsi" id="statusverifikasipropinsi1" value="1" checked>
                            <label class="form-check-label" for="statusverifikasipropinsi1">Setujui dan Lanjutkan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input radio-verifikasi-propinsi" type="radio" name="statusverifikasipropinsi" id="statusverifikasipropinsi2" value="2">
                            <label class="form-check-label" for="statusverifikasipropinsi2">Revisi Data</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3 deskripsi-revisi-propinsi" style="display: none;">
                <div class="form-group row">
                    <label for="" class="col-md-3">Deskripsi Revisi</label>
                    <div class="col-md-9">
                        <textarea name="deskripsirevisipropinsi" id="deskripsirevisipropinsi" class="form-control" rows="10" placeholder="Deskripsikan apa saja yang perlu direvisi"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

