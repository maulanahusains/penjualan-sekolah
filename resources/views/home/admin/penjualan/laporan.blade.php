@php
    $auth = Auth::User();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PENJUALAN | @yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('../assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('../assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('../assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('../assets/vendors/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('../assets/vendors/chartist/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('../assets/vendors/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('../assets/vendors/datatable/dataTables.bootstrap4.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('../assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('../assets/images/favicon.png')}}" />
    <script src="{{ asset('../assets/js/form-validation.js') }}"></script>
    <style>
        .main-panel {
            width: 100%
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <!-- Start:Sidebar -->
            <!-- End:Sidebar -->
            <!-- partial -->
            <div class="main-panel mt-5">
                <h3 style="text-align: center">LAPORAN PENJUALAN SEPATU</h3>
                <!-- Start:Content -->
                <div class="w-90 mx-auto">
                    <table class="mb-2">
                        <tr>
                            <th>Laporan</th>
                            <td>:</td>
                            <td>Laporan Penjualan Sepatu Sebulan</td>
                        </tr>
                        <tr>
                            <th>Pelapor</th>
                            <td>:</td>
                            <td>{{ Auth::User()->name }}</td>
                        </tr>
                        <tr>
                            <th>Range Laporan</th>
                            <td>:</td>
                            <td>{{ $awalLaporan->day }} {{ $awalLaporan->monthName }} - {{ $akhirLaporan->day }} {{ $akhirLaporan->monthName }}</td>
                        </tr>
                    </table>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>NO</th>
                                <th>NO PENJUALAN</th>
                                <th>MEMBER</th>
                                <th>KASIR</th>
                                <th>TANGGAL BAYAR</th>
                                <th>JUMLAH BAYAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualan as $u)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $u->no_penjualan }}</td>
                                <td>{{ $u->Member->name }}</td>
                                <td>{{ $u->Kasir->name }}</td>
                                <td>{{ $u->tanggal_bayar }}</td>
                                <td>Rp.{{ number_format($u->jumlah_bayar, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="mt-5">Bandung, {{ $today->day }} {{ $today->monthName }} {{ $today->year }}</p>
                    <br><br><br>
                    <p>Pengelola Penjualan</p>
                </div>

                <!-- End:Content -->
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('../assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('../assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('../assets/vendors/moment/moment.min.js')}}"></script>
    <script src="{{asset('../assets/vendors/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('../assets/vendors/chartist/chartist.min.js')}}"></script>
    <script src="{{asset('../assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('../assets/vendors/datatable/datatables.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('../assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('../assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('../assets/js/dashboard.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').dataTable();
        })
    </script>

    <!-- Start:Pesan Berhasil -->
    <!-- <script>
        Swal.fire('Berhasil', 'Data berhasil ...', 'success');
    </script> -->
    <!-- End:Pesan Berhasil -->

    <!-- Start:Pesan Gagal -->
    <!-- <script>
        Swal.fire('Gagal', 'Data gagal ...', 'error');
    </script> -->
    <!-- End:Pesan Gagal -->

    <!-- Start:Pesan Konfirmasi Hapus -->
    <script>
        function Delete(url) {
            Swal.fire({
                title: 'Yakin?',
                text: 'Apakah anda yakin akan menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                dangerMode: true,

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }
    </script>
    <!-- End:Pesan Konfirmasi Hapus -->
    <!-- End custom js for this page -->
</body>

</html>