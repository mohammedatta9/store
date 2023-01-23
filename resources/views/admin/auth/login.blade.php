<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::eBazar:: Signup </title>
    <link rel="icon" href="{{ url('/') }}/cp/favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="{{ url('/') }}/cp/assets/css/ebazar.style.min.css">
</head>
<body>
    
<div class="container-md">
    <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    
                                    <p class="text-muted  mb-0">تسجيل الدخول الى لوحة التحكم</p>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                @include('layouts.error')
                                <form class="my-4" method="post" action="{{ route('admin.dologin') }}">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="username">الايميل</label>
                                        <input type="email" class="form-control" required id="email" name="email" placeholder="Enter email">
                                    </div><!--end form-group-->

                                    <div class="form-group">
                                        <label class="form-label" for="userpassword">كلمة السر</label>
                                        <input type="password" class="form-control" required name="password" id="password" placeholder="Enter password">
                                    </div><!--end form-group-->

                                    <div class="form-group row mt-3">
                                        <div class="col-sm-6">
                                            <div class="form-check form-switch form-switch-success">
                                                <input class="form-check-input" type="checkbox" id="customSwitchSuccess">
                                                <label class="form-check-label" for="customSwitchSuccess">تذكرني</label>
                                            </div>
                                        </div><!--end col-->

                                    </div><!--end form-group-->

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid mt-3">
                                                <input class="btn btn-primary" type="submit" value='دخول' />
                                            </div>
                                        </div><!--end col-->
                                    </div> <!--end form-group-->
                                </form><!--end form-->
                                <div class="m-3 text-center text-muted">
                                    <p class="mb-0"> العودة الى الموقع     ?  <a href="../" class="text-primary ms-2">alwan website</a></p>
                                </div>

                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end card-body-->
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container-->

    <!-- Jquery Core Js -->
    <script src="{{ url('/') }}/cp/assets/bundles/libscripts.bundle.js"></script>
</body>
</html>