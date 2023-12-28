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
    <link rel="stylesheet" href="{{asset('../assets/vendors/fontawesome-free/css/all.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('../assets/css/style.css')}}">
    <!-- End layout styles -->
    <script src="{{ asset('../assets/vendors/jquery/jquery.min.js') }}"></script>
    <link rel="shortcut icon" href="{{asset('../assets/images/favicon.png')}}" />
    <script src="{{ asset('../assets/js/form-validation.js') }}"></script>
    <script>
        function reset(str) {
            return str.split('.').join('');
        }

        function makeItGood(e, realVal) { // nnti nambah rp
            e.value = reset(e.value).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            let sliced = (e.value).slice(3)
            $(`${realVal}`).val(reset(sliced))
        }
    </script>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex align-items-center">
                <a class="d-flex" href="{{ ($auth->level) ? '/dashboard' : '/member/dashboard'}}">
                    {{-- <img src="{{asset('../assets/images/brand.png')}}" alt="logo" class="logo-dark" width="50" height="50" /> --}}
                    <img src="{{asset('../assets/images/title.png')}}" alt="logo" class="logo-dark" width="150" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ ($auth->level) ? '/dashboard' : '/member/dashboard'}}"><img src="{{asset('../assets/images/logo-mini.svg')}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
                <h5 class="mb-0 font-weight-medium d-none d-lg-flex">{{ ($auth->level) ? 'Welcome To Admin Panel, '.$auth->name.'!' : 'Welcome To StepBeyond!' }}</h5>
                <ul class="navbar-nav navbar-nav-right ml-auto">
                    <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle ml-2" src="{{asset('../assets/images/faces/face8.jpg')}}" alt="Profile image"> <span class="font-weight-normal"> {{ $auth->name }} </span></a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{asset('../assets/images/faces/face8.jpg')}}" alt="Profile image">
                                <p class="mb-1 mt-3">{{ $auth->name }}</p>
                                {{-- <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p> --}}
                            </div>
                            <a href="{{ ($auth->level) ? '/admin/profile' : '/member/profile' }}" class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
                            <a href="{{ ($auth->level) ? '/admin/logout' : '/member/logout' }}" class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <!-- Start:Sidebar -->
            @include('layouts.sidebar')
            <!-- End:Sidebar -->
            <!-- partial -->
            <div class="main-panel">
                <!-- Start:Content -->
                @yield('content')
                <!-- End:Content -->
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
                    </div>
                </footer>
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
    @if(session('success'))
    <script>
        Swal.fire('Berhasil', '{{ session("success") }}', 'success');
    </script>
    @endif
    @if(session('error'))
    <script>
        Swal.fire('Gagal', '{{ session("error") }}', 'error');
    </script>
    @endif
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
        function JanganDelete(url) {
            Swal.fire({
                title: 'Yakin?',
                text: 'Apakah anda yakin akan menghapus data ini? (Semua data transaksi terkait data inipun akan dihapus!)',
                icon: 'warning',
                showCancelButton: true,
                dangerMode: true,

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }
        function Balik(url) {
            Swal.fire({
                title: 'Yakin?',
                text: 'Anda akan membatalkan edit profile ini?',
                icon: 'info',
                showCancelButton: true,
                dangerMode: false,

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }
        function cancel(url) {
            Swal.fire({
                title: 'Yakin?',
                text: 'Anda akan membatalkan mengedit data?',
                icon: 'info',
                showCancelButton: true,
                dangerMode: false,

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }

        function pindah(url) {
            window.location = url;
        }
    </script>
    <!-- End:Pesan Konfirmasi Hapus -->
    <!-- End custom js for this page -->
</body>

</html>