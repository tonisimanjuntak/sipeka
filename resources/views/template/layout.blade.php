<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIPEKA</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/sb-admin-2') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/sb-admin-2') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- datatables -->
    <link href="{{ asset('') }}assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- jquery-ui -->
    <link rel="stylesheet" href="{{ asset('') }}assets/jquery-ui/themes/base/jquery-ui.css">
    <!-- select2 -->
    <link href="{{ asset('') }}assets/select2/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('') }}assets/custom/style.css" rel="stylesheet" />

    <style>

        
        .loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 50%;
			height: 50%;
			z-index: 9999;
			background: url("{{ asset('images/Loading.gif') }}") 100% 100% no-repeat;
		}


    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('template/sidenavbar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('template/topnavbar')

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ url('login/logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="loader" style="display: none;"></div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/sb-admin-2') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/sb-admin-2') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/sb-admin-2') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/sb-admin-2') }}/js/sb-admin-2.min.js"></script>


    <!-- datatables -->
    <script src="{{ asset('') }}assets/datatables/js/jquery.dataTables.min.js"></script>
    <!-- jquery-mask -->
    <script type="text/javascript" src="{{ asset('') }}assets/jquery_mask/jquery.mask.js"></script>
    <!-- Bootstrap validator -->
    <script src="{{ asset('') }}assets/bootstrap-validator/js/bootstrapValidator.js"></script>
    <!-- jquery-ui -->
    <script src="{{ asset('') }}assets/jquery-ui/jquery-ui-2.js"></script>
    <!-- select2 -->
    <script src="{{ asset('') }}assets/select2/js/select2.min.js"></script>
    <!-- sweet Alert -->
    <script src="{{ asset('') }}assets/sweetalert/sweetalert.min.js"></script>
    <!-- CK Editor -->
    <script type="text/javascript" src="{{ asset('') }}assets/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="{{ asset('') }}assets/custom/script.js"></script>

    <!-- CSS -->
    <link href="https://unpkg.com/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />

    <!-- JavaScript -->
    <script src="https://unpkg.com/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>

    @if (session('success'))
    <script>
        swal("Berhasil", "{{ session('success') }}", "success");
    </script>
    @endif

    @if (session('fail'))
    <script>
        swal("Gagal", "{{ session('fail') }}", "warning");
    </script>
    @endif

    @if (session('other'))
    <script>
        swal("Upps!", "{{ session('other') }}", "info");
    </script>
    @endif

    @if (session('error'))
    <script>
        swal("Gagal", "{{ session('error') }}", "warning");
    </script>
    @endif
    
    <script>
        // 🔥 ON AJAX START: Tampilkan loading saat AJAX dimulai
        $(document).ajaxStart(function() {
            $('.loader').show();
            // Nonaktifkan semua tombol submit agar tidak double klik
            $('button[type="submit"]').prop('disabled', true);
        });

        // 🔥 ON AJAX STOP: Sembunyikan loading saat semua AJAX selesai
        $(document).ajaxStop(function() {
            $('.loader').hide();
            // Aktifkan kembali tombol submit
            $('button[type="submit"]').prop('disabled', false);
        });

        // 🔥 ON AJAX ERROR (Opsional): Tampilkan error umum
        $(document).ajaxError(function(event, xhr, options, error) {
            let errorMessage = 'Terjadi kesalahan pada permintaan.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }

            swal({
                icon: 'error',
                title: 'Error!',
                text: errorMessage
            });
        });
        
    </script>

    <script>
        $(".rupiah").mask("000,000,000,000", {
            reverse: true,
            placeholder: "000,000,000,000"
        });

        $(".rupiah").css("text-align", "right");

        $(".persen").mask("000.00", {
            reverse: true,
            placeholder: "000.00"
        });

        $(".persen").css("text-align", "right");

        $(".nik").mask("0000000000000000", {
            reverse: true,
            placeholder: "Nomor induk kependudukan"
        });
        $(".nip").mask("000000000000000000", {
            reverse: true,
            placeholder: "Nomor Induk Pegawai"
        });
        $(".notelp").mask("00000000000000000000", {
            reverse: true,
            placeholder: "Nomor telepon"
        });
        $(".nowa").mask("00000000000000000000", {
            reverse: true,
            placeholder: "Nomor whatsapp"
        });
        $(".npwp").mask("000000000000000", {
            reverse: true,
            placeholder: "Nomor pokok wajib pajak"
        });
        $(".kode-kabupaten").mask("0000", {
            reverse: true,
            placeholder: "Kode kabupaten"
        });
        $(".kode-kecamatan").mask("000000", {
            reverse: true,
            placeholder: "Kode kecamatan"
        });
        $(".kode-kelurahan").mask("0000000000", {
            reverse: true,
            placeholder: "Kode kabupaten"
        });

        function format_decimal(number, decPlaces, decSep, thouSep) {
            decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSep = typeof decSep === "undefined" ? "." : decSep;
            thouSep = typeof thouSep === "undefined" ? "," : thouSep;
            var sign = number < 0 ? "-" : "";
            var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
            var j = (j = i.length) > 3 ? j % 3 : 0;

            return sign +
                (j ? i.substr(0, j) + thouSep : "") +
                i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
                (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
        }

        function format_rupiah(number, decPlaces = 0, decSep = ".", thouSep = ",") {
            // Pastikan number adalah angka
            number = parseFloat(number);
            if (isNaN(number)) {
                return "0";
            }

            // Tentukan tanda (negatif atau positif)
            var sign = number < 0 ? "-" : "";

            // Ambil bagian integer
            var i = String(Math.floor(Math.abs(number)));

            // Tambahkan separator ribuan
            var j = i.length > 3 ? i.length % 3 : 0;
            var thousands = (j ? i.substr(0, j) + thouSep : "") +
                i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSep);

            // Ambil bagian desimal
            var decimals = decPlaces ? decSep + Math.abs(number - Math.floor(number)).toFixed(decPlaces).slice(2) : "";

            // Gabungkan semua bagian
            return sign + thousands + decimals;
        }

        function addSelectOption(selectId, optValue, optText) {
            var select = document.getElementById(selectId);
            var option = document.createElement("option");
            option.value = optValue;
            option.innerHTML = optText;
            select.appendChild(option);
        }

        function hilangkanTitik(input) {
            // Menggunakan metode replace dengan regular expression untuk menghapus semua tanda titik
            return input.replace(/\./g, '');
        }
    </script>

    @yield('javascript')

    <script>

        $(document).ready(function () {
            
            $('.searchKabupaten').select2({
                placeholder: '-- Nama kabupaten --',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ url('select2/searchKabupaten') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchKecamatan').select2({
                placeholder: '-- Nama kecamatan --',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ url('select2/searchKecamatan') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                            kodekabupaten: $('#kodekabupaten').val(),
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchKelurahan').select2({
                placeholder: '-- Nama kelurahan --',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ url('select2/searchKelurahan') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

        });
    </script>

</body>

</html>