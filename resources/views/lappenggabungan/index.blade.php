@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">LAPORAN PEMBENTUKAN</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">PILIH PERIODE LAPORAN</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2"></div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Tanggal
                                            Periode</label>
                                        <div class="col-md-4">
                                            <input type="date" name="tglawal" id="tglawal" class="form-control"
                                                value="{{ date('Y-m-d') }}">
                                        </div>
                                        <label for="" class="col-md-1 col-form-label text-center">s/d</label>
                                        <div class="col-md-4">
                                            <input type="date" name="tglakhir" id="tglakhir" class="form-control"
                                                value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-5 text-center">
                                    <button class="btn btn-danger ml-1" id="btnCetakPdf"><i class="fa fa-file-pdf"></i>
                                        Cetak PDF</button>
                                    {{-- <button class="btn btn-success" id="btnCetakExcel"><i
                                            class="fa fa-file-excel"></i>
                                        Cetak Excel</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->

    </div>

</div>
<!-- /.container-fluid -->

@endsection


@section('javascript')

<script>
    $('#btnCetakExcel').click(function() {
            cetak('excel');
        });

        $('#btnCetakPdf').click(function() {
            cetak('pdf');
        });

        function cetak(jenis)
        {
            var tglawal = $('#tglawal').val();
            var tglakhir = $('#tglakhir').val();

            if (tglawal === '' || tglakhir === '') {
                swal("Informasi", "Tanggal periode belum dipilih!", "info");
                return;
            }

            window.open("{{ url('lappembentukan/cetak') }}" + "/" + jenis + "/" + tglawal + "/" + tglakhir);                
        }
</script>

@endsection