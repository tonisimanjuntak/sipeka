@extends('template/layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PEMBENTUKAN KECAMATAN</h1>
    </div>

    
        @csrf
        <input type="hidden" name="ltambah" id="ltambah" value="{{ $ltambah }}">
        <input type="hidden" name="kodekabupaten" id="kodekabupaten" value="{{ session('kodekabupaten') }}">

        <div class="row">
            <!-- Area Chart -->
            <div class="col-12">
                
                <!-- SmartWizard html -->
                <div id="smartwizard">
                    <ul class="nav">
                        <li class="nav-item">
                        <a class="nav-link" href="#step-1">
                            <div class="num">1</div>
                            PENGAJUAN
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#step-2">
                            <span class="num">2</span>
                            VERIFIKASI PROPINSI
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#step-3">
                            <span class="num">3</span>
                            UPLOAD RAPERDA
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="#step-4">
                            <span class="num">4</span>
                            TELAAHAN
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="#step-5">
                            <span class="num">5</span>
                            PERMOHONAN KODE
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="#step-6">
                            <span class="num">6</span>
                            REKOMENDASI GUBERNUR
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="#step-7">
                            <span class="num">7</span>
                            KIRIM KE KEMENDAGRI
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="#step-8">
                            <span class="num">8</span>
                            SK KEMENDAGRI
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="#step-9">
                            <span class="num">9</span>
                            SELESAI
                        </a>
                        </li>
                    </ul>
                
                    <div class="tab-content">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            @include('pembentukankecamatan.pengajuan')
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            @include('pembentukankecamatan.verifikasipropinsi')
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            @include('pembentukankecamatan.uploadraperda')
                        </div>
                        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            @include('pembentukankecamatan.telaahan')
                        </div>
                        <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                            @include('pembentukankecamatan.permohonankode')
                        </div>
                        <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-6">
                            @include('pembentukankecamatan.rekomendasigubernur')
                        </div>
                        <div id="step-7" class="tab-pane" role="tabpanel" aria-labelledby="step-7">
                            @include('pembentukankecamatan.kirimkekemendagri')
                        </div>
                        <div id="step-8" class="tab-pane" role="tabpanel" aria-labelledby="step-8">
                            @include('pembentukankecamatan.skkemendagri')
                        </div>
                        <div id="step-9" class="tab-pane" role="tabpanel" aria-labelledby="step-9">
                            @include('pembentukankecamatan.selesai')
                        </div>
                    </div>
                
                    <!-- Include optional progressbar HTML -->
                    <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
    var nopengajuan = "{{ $nopengajuan }}";

    $(document).ready(function() {

        $('.select2').select2();

        if (nopengajuan != "") {
            $('#nopengajuan').val(nopengajuan);
            $('.id-primary').html('ID: ' + nopengajuan);
            $('.label-judul .label-aksi').html('Edit');

            $.ajax({
                    url: "{{ url('pembentukankecamatan/getId') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'nopengajuan': nopengajuan
                    },
                })
                .done(function(response) {
                    console.log(response);
                    $('#namapembentukankecamatan').val(response['namapembentukankecamatan']);
                    $('#statusaktif').val(response['statusaktif']).trigger('change');
                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            $('.label-judul .label-aksi').html('Tambah');
        }

        
        
        //smart wizard configurations                             
        $('#smartwizard').smartWizard({
            selected: 0, // Initial selected step, 0 = first step
            theme: 'dots', // theme for the wizard, related css need to include for other than default theme
            justified: true, // Nav menu justification. true/false
            autoAdjustHeight: false, // Automatically adjust content height
            backButtonSupport: true, // Enable the back button support
            enableUrlHash: false, // Enable selection of the step based on url hash
            transition: {
            animation: 'slideSwing', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
            speed: '400', // Animation speed. Not used if animation is 'css'
            easing: '', // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
            prefixCss: '', // Only used if animation is 'css'. Animation CSS prefix
            fwdShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on forward direction
            fwdHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on forward direction
            bckShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on backward direction
            bckHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on backward direction
            },
            toolbar: {
            position: 'bottom', // none|top|bottom|both
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            extraHtml: `
                <button class="btn btn-success btnSelesai" onclick="onFinish()">Selesai</button>` // Extra html to show on toolbar
            },
            anchor: {
            enableNavigation: true, // Enable/Disable anchor navigation 
            enableNavigationAlways: false, // Activates all anchors clickable always
            enableDoneState: true, // Add done state on visited steps
            markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
            enableDoneStateNavigation: true // Enable/Disable the done state navigation
            },
            keyboard: {
            keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            keyLeft: [37], // Left key code
            keyRight: [39] // Right key code
            },
            lang: { // Language variables for button
            next: 'Simpan Dan Lanjutkan',
            previous: 'Sebelumnya'
            },
            disabledSteps: [], // Array Steps disabled
            errorSteps: [], // Array Steps error
            warningSteps: [], // Array Steps warning
            hiddenSteps: [], // Hidden steps
            getContent: null // Callback function for content loading
        });


        
        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {

            // var form_data = $("#form" + stepNumber).serialize();
            // console.log(stepNumber);
            // console.log(stepDirection);


            if (stepNumber == 0) {
                if (stepDirection == 1) {

                    const bootstrapValidator = $('#formPengajuan').data('bootstrapValidator');
                    bootstrapValidator.validate();
                    if (bootstrapValidator.isValid()) {
                        simpanPengajuan();
                        return true; // Lanjutkan ke langkah berikutnya
                    } else {                        
                        return false; // Hentikan navigasi jika form tidak valid
                    }

                    // return false;
                } else {
                    return true;
                }
            }



            if (stepNumber == 2) {
            if (stepDirection == 3) {
                if (!table.data().count()) {
                swal("Detail Tempat dan Tanggal!", "Detail tempat dan tanggal belum ada.", "info");
                return false;
                }
            }
            return true;
            }

            if (stepNumber == 3) {
            return true;
            }

            if (stepNumber == 4) {
            return true;
            }

            return false;

        });

        $("form").attr('autocomplete', 'off');
        
    });

    
        
</script>

@include('pembentukankecamatan.verifikasipropinsi_js')
@include('pembentukankecamatan.pengajuan_js')

@endsection