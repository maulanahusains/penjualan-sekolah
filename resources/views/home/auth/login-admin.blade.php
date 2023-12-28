<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PENJUALAN | LOGIN</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('../../assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('../../assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('../../assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('../../assets/vendors/sweetalert2/sweetalert2.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('../../assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('../../assets/images/favicon.png')}}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <img src="{{asset('../../assets/images/brand-light.png')}}" width="120px" height="120px">
                            {{-- <div class="d-flex align-items-center"> --}}
                                {{-- <div class="brand-logo display-inline m-0">
                                    <img src="{{asset('../../assets/images/title-light.png')}}">
                                </div> --}}
                            {{-- </div> --}}
                            <h4>Hello!</h4>
                            <h6 class="font-weight-light">Sign in to continue as admin.</h6>
                            <form class="pt-3" method="POST" action="/admin/postlogin">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name='username' class="form-control form-control-lg" id='username' value="{{old('username')}}" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name='password' class="form-control form-control-lg" id='password' value="{{old('password')}}" placeholder="Password">
                                </div>
                                <div class="mt-2">
                                    <a href="/member/login">Are you a Member?</a>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                                </div>
                            </form>
                            @if(session('error'))
                            <div class="mt-2 alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('../../assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('../../assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('../../assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('../../assets/js/misc.js')}}"></script>
    <!-- endinject -->

    <!-- Start:Pesan Gagal -->
    <!-- <script>
        Swal.fire('Gagal', 'Username atau Password Gagal', 'error');
    </script> -->
    <!-- End:Pesan Gagal -->
</body>

</html>