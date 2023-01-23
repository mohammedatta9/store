@extends('layouts.admin.main')
@section('content')
    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content-tab">

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            
                            <h4 class="page-title">اضف مستخدم</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                    @include('layouts.success')
                    @include('layouts.error')
                </div>
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                             <!--end card-body-->
                            <div class="card-body p-0">
                                <!-- Nav tabs -->
                                

                                <!-- Tab panes -->
                                <div class="tab-content">
                                   
                                    <div class="tab-pane p-3 active" id="Settings" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6">
                                                     <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title"> معلومات المستخدم  </h4>
                                                            </div><!--end col-->
                                                        </div>  <!--end row-->
                                                    </div><!--end card-header-->
                                                   
                                                        <form name="" method="post" action="{{ route('admin.admin.store' )}}">
                                                            @csrf
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">الاسم  </label>
                                                            <div class="col-lg-9 col-xl-8">
                                                               @error('first_name')
                                                                <small class="form-text text-danger">{{$message}}</small>
                                                                @enderror
                                                                <input class="form-control" type="text" value="{{ old('first_name') }}" maxlength="100" name="first_name">
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">الايميل</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                            @error('email')
                                                                    <small class="form-text text-danger">{{$message}}</small>
                                                                    @enderror 
                                                                <div class="input-group">
                                                                                                                                 
                                                                    <input type="text" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email" maxlength="100"  aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                         
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">كلمة السر  </label>
                                                            <div class="col-lg-9 col-xl-8">
                                                            @error('password')
                                                                    <small class="form-text text-danger">{{$message}}</small>
                                                                    @enderror 
                                                                <input class="form-control" type="password" maxlength="100"  name="password"   >
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">تأكيد كلمة السر</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="password" maxlength="100"   name="password_confirmation">
                                                            </div>
                                                        </div>
                                                             
                                                            <div class="form-group mb-3 row">
                                                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                                <button type="submit" class="btn btn-primary">
                                                                حفظ
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>

                                                    
                                                </div>
                                            </div> <!--end col-->
                                             
                                        </div><!--end row-->
                                    </div>
                                </div>
                            </div> <!--end card-body-->
                     </div><!--end col-->
                </div><!--end row-->

            </div><!-- container -->

            <!--Start Rightbar-->
            <!--Start Rightbar/offcanvas-->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
                    <button type="button" class="btn-close text-reset p-0 m-0 align-self-center"
                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h6>Account Settings</h6>
                    <div class="p-2 text-start mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch1">
                            <label class="form-check-label" for="settings-switch1">Auto updates</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                            <label class="form-check-label" for="settings-switch2">Location Permission</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="settings-switch3">
                            <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                        </div><!--end form-switch-->
                    </div><!--end /div-->
                    <h6>General Settings</h6>
                    <div class="p-2 text-start mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch4">
                            <label class="form-check-label" for="settings-switch4">Show me Online</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                            <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="settings-switch6">
                            <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                        </div><!--end form-switch-->
                    </div><!--end /div-->
                </div><!--end offcanvas-body-->
            </div>
            <!--end Rightbar/offcanvas-->
            <!--end Rightbar-->


        </div>
        <!-- end page content -->
    </div>

@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

<!-- get cities -->
<script>
    $(document).ready(function () {
        $('select[name="country_id"]').on('change', function () {
            var country = $(this).val();
            if (country) {
                $.ajax({
                    url: "{{ URL::to('get_cities') }}/" + country,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option selected disabled value="" >اختار مدينة</option>');
                        $.each(data, function (key, value) {
                            $('select[name="city_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endpush