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
                            
                            <h4 class="page-title">معلومات عن المستخدم</h4>
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
                            <div class="card-body">
                                <div class="met-profile">
                                    <div class="row">
                                        <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                            <div class="met-profile-main">
                                                <div class="met-profile-main-pic">
                                                   
                                                </div>
                                                <div class="met-profile_user-detail">
                                                    <h5 class="met-user-name">{{ $mentor->fname." ".$mentor->lname }}</h5>
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-4 ms-auto align-self-center">
                                            <ul class="list-unstyled personal-detail mb-0">
                                                
                                                <li class="mt-2"><i
                                                            class="las la-envelope text-secondary font-22 align-middle mr-2"></i>
                                                    <b> Email </b> : {{ $mentor->email }}</li>
                                                <li class="mt-2"><i
                                                            class="las la-globe text-secondary font-22 align-middle mr-2"></i>
                                                    <b> العنوان </b> : @if($mentor->country){{ $mentor->country->name }} - @endif @if($mentor->city){{ $mentor->city->name }} - @endif {{ $mentor->address}} 
                                                </li>
                                            </ul>

                                        </div><!--end col--><br><hr>
                                        <b> طلبيات المستخدم </b>
                                        @if($mentor->orders->count() == 0 ) <b>لا يمتلك هذا المستحدم طلبيات</b>@else
                                        <div class="table-responsive">
                                 <table id="example" class="table table-striped table-bordered" style="width:90%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المجموع</th>
                                        <th> التاريخ</th>
                                        <th>عدد المنتجات</th>

                                        <th>تفاصيل</th>
                                         
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mentor->orders as $c)
                                    <tr  >
                                        <td>{{$c->id}} </td>
                                        <td>{{$c->total}}د.ك </td>
                                        <td>{{$c->created_at->format('d/m/Y')}} </td>

                                        <td>{{$c->items->count()}} </td>
                                        <td>  <a href="{{ route('admin.order.profile', $c->id)}}"><i class="icofont-edit text-secondary font-20"></i></a>
                                         </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                 </table>
                                 </div>@endif
                                     
                                    </div><!--end row-->
                                </div><!--end f_profile-->
                            </div><!--end card-body-->
                            <div class="card-body p-0">
                                <!-- Nav tabs -->
                                

                                <!-- Tab panes -->
                                <div class="tab-content">
                                   
                                    <div class="tab-pane p-3 active" id="Settings" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title"> معلومات المستخدم  </h4>
                                                            </div><!--end col-->
                                                        </div>  <!--end row-->
                                                    </div><!--end card-header-->
                                                    <div class="card-body">
                                                        <form name="" method="post" action="{{ route('admin.user.save',[$mentor->id]) }}">
                                                            @csrf
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">الاسم الاول</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="text" value="{{ $mentor->fname }}" maxlength="100" name="first_name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">الاسم الثاني</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="text" value="{{ $mentor->lname }}" maxlength="100" name="last_name">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">الايميل</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                                class="las la-at"></i></span>
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $mentor->email }}" name="email"
                                                                           placeholder="Email" maxlength="100"
                                                                           aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                         
                                                        <div class="mb-3 row">
                                                                    <label   class="col-sm-3 col-form-label text-end">الدولة</label>
                                                                    <div class="col-sm-9">
                                                                    @error('country_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                                    <select class="form-control"  id="country_id" name="country_id" required>
                                                                            <option>الدولة</option>
                                                                            @foreach($countries as $co)
                                                                            <option value="{{$co->id}}"
                                                                            {{ $mentor->country_id == $co->id ? 'selected' : '' }}  >{{$co->name}}</option>
                                                                            
                                                                            @endforeach
                                                                        </select>        
                                                                    </div>
                                                                </div> 
                                                                <div class="mb-3 row">
                                                                    <label   class="col-sm-3 col-form-label text-end">المدينة</label>
                                                                    <div class="col-sm-9">
                                                                    @error('city_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                                    <select class="form-control" name="city_id" id="city_id" >
                                                                    @if( $mentor->city )
                                                                            <option value="{{$mentor->city_id}}" selected>{{$mentor->city->name}}</option>@endif
                                                                        </select>       
                                                                    </div>
                                                                </div>  
                                                            <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">العنوان</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="text" value="{{ $mentor->address }}" maxlength="100" name="address">
                                                            </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Status</label>
                                                                <div class="col-lg-9 col-xl-8">
                                                                    <input class="form-check-input" type="checkbox" value="1"
                                                                           id="Email_Notifications" name="status" @if($mentor->status == 1)checked @endif>
                                                                    <label class="form-check-label" for="Email_Notifications">
                                                                        active
                                                                    </label>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group mb-3 row">
                                                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                                <button type="submit" class="btn btn-primary">
                                                                    تحديث
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div> <!--end col-->
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">   تغيير كلمة السر</h4>
                                                    </div><!--end card-header-->
                                                    <div class="card-body">
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">كلمة السر الجديدة</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="password" maxlength="100"
                                                                       placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">تأكيد كلمة السر</label>
                                                            <div class="col-lg-9 col-xl-8">
                                                                <input class="form-control" type="password" maxlength="100"
                                                                       placeholder="Re-Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                                <button type="submit" class="btn btn-primary">تغيير كلمة السر  </button>
                                                                 
                                                            </div>
                                                        </div>
                                                    </div><!--end card-body-->
                                                </div><!--end card-->
                                                 
                                            </div> <!-- end col -->
                                        </div><!--end row-->
                                    </div>
                                </div>
                            </div> <!--end card-body-->
                        </div><!--end card-->
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