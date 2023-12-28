<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stellar Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets/vendors/chartist/chartist.min.css">
    <link rel="stylesheet" href="../assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/vendors/datatable/dataTables.bootstrap4.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex align-items-center">
                <a class="navbar-brand brand-logo" href="index.html">
                    <img src="../assets/images/logo.svg" alt="logo" class="logo-dark" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
                <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome stallar dashboard!</h5>
                <ul class="navbar-nav navbar-nav-right ml-auto">
                    <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle ml-2" src="../assets/images/faces/face8.jpg" alt="Profile image"> <span class="font-weight-normal"> Henry Klein </span></a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3">Allen Moreno</p>
                                <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
                            </div>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
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
            <?php
            include('sidebar.php');
            ?>
            <!-- End:Sidebar -->
            <!-- partial -->
            <div class="main-panel">
                <!-- Start:Content -->
                <?php
                // bisa disesuaikan berdasarkan konten yg akan di buat dashboard.php(tampilan utama aplikasi)/content.php(tampilan pengelolaan CRUD)/form.php(tampilan input/edit data)
                include('content.php');
                ?>
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
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/moment/moment.min.js"></script>
    <script src="../assets/vendors/daterangepicker/daterangepicker.js"></script>
    <script src="../assets/vendors/chartist/chartist.min.js"></script>
    <script src="../assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/vendors/datatable/datatables.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
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