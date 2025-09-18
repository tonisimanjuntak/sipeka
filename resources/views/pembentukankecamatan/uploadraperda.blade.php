<div class="card">
    <div class="card-body card-wizard">
        <div class="row">
            <div class="col-12 mb-5">
                <h5 class="text-primary">UPLOAD RAPERDA</h5>
            </div>

            <div class="col-12">

                <div class="form-group row">
                    <label for="nomorraperda" class="col-md-3">Nomor Raperda</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="nomorraperda" name="nomorraperda" placeholder="Nomor Raperda">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tglraperda" class="col-md-3">Tanggal Raperda</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="tglraperda" name="tglraperda" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-md-3">File Raperda</label><label class="col-md-9"><input type="file" class="form-control" id="fileraperda" name="fileraperda"></label>
                </div>
            </div>

        </div>
    </div>
</div>

