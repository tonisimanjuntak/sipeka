<div class="card">
    <div class="card-body card-wizard">
        <div class="row">
            <div class="col-12 mb-5">
                <h5 class="text-primary">PERMOHONAN KODE</h5>
            </div>

            <div class="col-12">
                <div class="form-group row">
                    <label for="tglpermohonankode" class="col-md-3">Nomor Permohonan Kode</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="nopermohonankode" name="nopermohonankode" placeholder="Nomor permohonan kode">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tglpermohonankode" class="col-md-3">Tanggal Permohonan Kode</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="tglpermohonankode" name="tglpermohonankode" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-md-3">Upload File Permohonan</label><label class="col-md-9"><input type="file" class="form-control" id="filepermohonankode" name="filepermohonankode"></label>
                </div>
            </div>

        </div>
    </div>
</div>

