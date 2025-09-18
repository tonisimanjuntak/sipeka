<div class="card">
    <div class="card-body card-wizard">
        <div class="row">
            <div class="col-12 mb-5">
                <h5 class="text-primary">TELAAHAN HUKUM DAN TEKNIS</h5>
            </div>

            <div class="col-12">
                <div class="form-group row">
                    <label for="nomorregister" class="col-md-3">Nomor Register</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="nomorregister" name="nomorregister" placeholder="Nomor register">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgluploadraperda" class="col-md-3">Tanggal Register</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="tgluploadraperda" name="tgluploadraperda" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-md-3">Telaahan Hukum</label><label class="col-md-9"><input type="file" class="form-control" id="filetelaahanhukum" name="filetelaahanhukum"></label>
                </div>


                <div class="form-group row">
                    <label for="" class="col-md-3">Telaahan Teknis</label><label class="col-md-9"><input type="file" class="form-control" id="filetelaahanteknis" name="filetelaahanteknis"></label>
                </div>
            </div>

        </div>
    </div>
</div>

