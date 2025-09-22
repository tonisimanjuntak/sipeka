@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PENGGABUNGAN KECAMATAN</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">LIST DATA PENGGABUNGAN KECAMATAN</h6>
                    @if (session('akseslevel') == 'Operator Kabupaten')
                    @endif
                </div>
                <!-- Card Body -->
                <div class="card-body d-flex align-items-center" style="min-height: 400px">
                    <div class="row w-100">
                        <div class="col-12 text-center">
                            <h3>Halaman Ini Sedang Dalam Proses Pengembangan...</h3>
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
    var table;

    $(document).ready(function() {
        

    });


</script>

@endsection