@extends('layouts.layoutSite.SitePage')

 @section('content')

<!-- start breadcrumb -->

<section class="section-breadcrumb p-2">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                  <li class="breadcrumb-item"><a href="#">حسابي</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> </li>
                </ol>
              </nav>
        </div>
    </div>
</section>
<!-- end breadcrumb -->
@if ($errors->any())
    <div class="alert alert-danger col-md-4">
        تأكد من المعلومات المدخلة
    </div>
@endif
<!-- start tab -->
<section class="container section-tab-downloads">
    <div class="row">
        <div class="col-md-4 ps-0 pe-lg-5">
            <div class="nav flex-md-column nav-pills me-md-3 p-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <div class="d-flex align-items-center w-100 p-1 flex-fill">
                    <span  class="bi bi-person-circle person-img"></span>
                    <span class="tab-person-name">{{\Illuminate\Support\Facades\Auth::user()->fname}}</span>
                </div>  
                <button class="nav-link flex-fill active" id="v-pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab" aria-controls="v-pills-dashboard" aria-selected="true">لوحة التحكم</button>
                <button class="nav-link flex-fill" id="v-pills-request-tab" data-bs-toggle="pill" data-bs-target="#v-pills-request" type="button" role="tab" aria-controls="v-pills-request" aria-selected="false">الطلبات</button>
                <button class="nav-link flex-fill " id="v-pills-downloads-tab" data-bs-toggle="pill" data-bs-target="#v-pills-downloads" type="button" role="tab" aria-controls="v-pills-downloads" aria-selected="false">العناوين</button>
                <button class="nav-link flex-fill" id="v-pills-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-address" type="button" role="tab" aria-controls="v-pills-address" aria-selected="false">اضافة عنوان</button>
                <button class="nav-link flex-fill" id="v-pills-details-tab" data-bs-toggle="pill" data-bs-target="#v-pills-details" type="button" role="tab" aria-controls="v-pills-details" aria-selected="false">تفاصيل الحساب</button>
              <form method="POST" action="{{ route('logout') }}" class="btn btn-log-out flex-fill">
                                                @csrf
                                            <a href="{{route('logout')}}" class="btn"
                                               onclick="event.preventDefault();
                                               this.closest('form').submit();">
                                                تسجيل خروج </a>
                                            </form>
              </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab" tabindex="0">
                <p>مرحبا <strong>{{\Illuminate\Support\Facades\Auth::user()->fname}}</strong>
{{--                                                    (not <strong>UserName</strong>? <small><a href="https://tunatheme.com/tf/html/quarter-preview/quarter-rtl/login-register.html">Log out</a></small> )--}}
                                                </p>
                                                <p>من لوحة معلومات حسابك ، يمكنك عرض ملف <span>الطلبات الأخيرة</span> و ادارة ، <span>عناوين الشحن والفواتير و</span> <span>تعديل كلمة المرور وتفاصيل الحساب</span>.</p>
                                           
                </div>
                <div class="tab-pane fade" id="v-pills-request" role="tabpanel" aria-labelledby="v-pills-request-tab" tabindex="0"> 
                     <div class="table-responsive section-table mt-md-5">
                    <table class="table border mt-md-5">
                        <thead>
                          <tr>
                            <th scope="col">رقم الطلب </th>
                            <th scope="col"> المجموع  </th>
                            <th scope="col"> عدد المنتجات  </th>
                            <th scope="col">الحالة  </th>
                            <th scope="col">الغاء الطلب</th>
                            <th scope="col">عرض الطلب</th>
                             
                          </tr>
                        </thead>
                        <tbody>
                            @foreach(\Illuminate\Support\Facades\Auth::user()->orders as $order)
                          <tr class="R_order{{$order->id}}">
                          <th scope="row">{{$order->id}}</th>
                          <td>د.ك  {{$order->total}} </td>
                          <td>    {{$order->items->count()}} </td>
                            <td >{{$order->status}}</td>
                            <th >@if($order->status == 2) تم الشحن@else<a href="" class="deletem_order" deletem_order="{{$order->id}}" >الغاء</a> @endif</th>
                            <th ><a href="showorder/{{$order->id}}"   >عرض</a> </th>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    

                </div></div>
                <div class="tab-pane fade " id="v-pills-downloads" role="tabpanel" aria-labelledby="v-pills-downloads-tab" tabindex="0">
                    <div class="table-responsive section-table mt-md-5">
                    <table class="table border mt-md-5">
                        <thead>
                          <tr>
                            <th scope="col">اسم  </th>
                            <th scope="col"> الايميل  </th>
                            <th scope="col">المنطقة  </th>
                            <th scope="col">الشارع</th>
                            <th scope="col">رقم الموبايل</th>
                            <th scope="col"> المنزل </th>
                            <th scope="col"> الجادة </th>
                            <th scope="col"> حدف </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach(\Illuminate\Support\Facades\Auth::user()->addresses as $address)
                          <tr class="R_address{{$address->id}}">
                          <th scope="row">{{$address->name}}</th>
                            <td>{{$address->email}}</td>
                            <td >{{$address->area}}</td>
                            <th >{{$address->street}}</th>
                            <td>{{$address->phone}}</td>
                            <td>{{$address->house}}</td>
                            <td>{{$address->Blvd}}</td>
                            <td><a href="" class="deletem_b" deletem_b="{{$address->id}}" >حدف</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                </div>
                <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab" tabindex="0">
                    
<section class="container section-creat-account">
    <div class="row">
        <p class="h6">  العناوين التالية سيتم استحدامها في صفحة إتمام الطلب بشكل افتراضي </p><br>
        <div class="col-md-4">
        <form method="POST" action="{{ route('user.location.save') }}" class="ltn__form-box contact-form-box">
                            @csrf
                            <div class="mb-8">
            <p style="color:red">* <label style="color:black" >الاسم</label></p> 
                @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                <input type="text" name="name"  value="{{old('name')}}" placeholder="الاسم " maxlength="100" required>
              </div><br>
      <div class="mb-8">
            <p style="color:red">* <label style="color:black" >البريد الالكتروني</label></p> 
                @error('email')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                <input type="text" name="email"  value="{{old('email')}}" placeholder="البريد الالكتروني" maxlength="100" required>
              </div><br>
         <div class="mb-8">
            <p style="color:red">* <label style="color:black" >   المنطقة</label></p> 
                @error('area')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                            <select class="form-control"  name="area">
                                                     
                                                     @if( old('area') )
                                                     <option value="{{old('area')}}" selected>{{old('area')}}</option>@endif
                                                     <option value="">   اختر منطقة  </option>
                                                     @foreach($cities as $ca)
                                                     <option value="{{$ca->name}}"> {{$ca->name}}</option>
                                                     @endforeach
                                                 </select>               </div><br>
              <div class="mb-8">
            <p style="color:red">* <label style="color:black" >  الشارع</label></p> 
                @error('street')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                <input type="text" name="street"  value="{{old('street')}}" placeholder=" الشارع  " maxlength="100" required>
              </div><br>
              <div class="mb-8">
             <label style="color:black" >  الجادة</label><br>
          
                <input type="text" name="Blvd"  value="{{old('Blvd')}}" placeholder=" الجادة  " maxlength="100"  ><br>
              </div><br>
              <div class="mb-8">
            <label style="color:black" >   الشقة\المنزل</label> 
               
                <input type="text" name="house"  value="{{old('house')}}" placeholder=" الشقة\المنزل  " maxlength="100" >
              </div><br>
        <div class="mb-8">
        <p style="color:red">* <label style="color:black" >   رقم الموبايل</label></p> 
            @error('phone')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            <input type="text" name="phone" value="{{old('phone')}}" placeholder=" رقم الموبايل" maxlength="100" required >
          </div>
          <input type="submit" class="btn btn-warning w-100 btn-create-acount my-4 text-light" value="إشاء عنوان">

</form>
               
         
        </div>
    </div>
</section>
                </div>
                <div class="tab-pane fade" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab" tabindex="0">
                <section class="container section-creat-account">
               <div class="row">
                  <p class="h6">  العناوين التالية سيتم استحدامها في صفحة إتمام الطلب بشكل افتراضي </p>
                  <br>
                  <div class="col-md-4">
                     <div id="success_message_security"></div>
                     <form  name="learner_security" id="learner_security" enctype="multipart/form-data" method="post" action="">
                        @csrf
                        <div class="mb-8">
                           <p style="color:red">* <label style="color:black" >الاسم الاول</label></p>
                           @error('fname')
                           <small class="form-text text-danger">{{$message}}</small>
                           @enderror
                           <input type="text" name="fname"  value="{{Auth::user()->fname}}" placeholder="الاسم الاول" maxlength="100" required>
                        </div>
                        <br>
                        <div class="mb-8">
                           <p style="color:red">* <label style="color:black" >الاسم الثاني</label></p>
                           @error('lname')
                           <small class="form-text text-danger">{{$message}}</small>
                           @enderror
                           <input type="text" name="lname"  value="{{Auth::user()->lname}}" placeholder="الاسم الثاني" maxlength="100" required>
                        </div>
                        <br>
                        <div class="mb-8">
                           <p style="color:red">* <label style="color:black" >البريد الالكتروني</label></p>
                           @error('email')
                           <small class="form-text text-danger">{{$message}}</small>
                           @enderror
                           <input type="text" name="email"   value="@if(Auth::user()->email) {{ Auth::user()->email }} @endif" placeholder="البريد الالكتروني" maxlength="100" required>
                        </div>
                        <br> 
                        <label for="user-password" class="form-label"> تغيير كلمة المرور</label>
                        <div class="input-group">
                           @error('old_password')
                           <small class="form-text text-danger">{{$message}}</small>
                           @enderror
                           <button type="button" class="btn btn-eye bi bi-eye"></button>
                           <input type="password" class="form-control" name="old_password" aria-label="user-password" aria-describedby="user-password" placeholder=" كلمة المرور القديمة">
                        </div>
                        <br>
                        <div class="input-group">
                           @error('new_password')
                           <small class="form-text text-danger">{{$message}}</small>
                           @enderror
                           <button type="button" class="btn btn-eye bi bi-eye"></button>
                           <input type="password" class="form-control" name="new_password" aria-label="user-password" aria-describedby="user-password" placeholder=" كلمة المرور الجديدة">
                        </div>
                        <br>
                        <div class="mb-3">
                           <div class="input-group">
                              @error('password_confirmation')
                              <small class="form-text text-danger">{{$message}}</small>
                              @enderror
                              <button type="button" class="btn btn-eye bi bi-eye"></button>
                              <input type="password" class="form-control" name="password_confirmation" aria-label="user-password" aria-describedby="user-password" placeholder=" تاكيد كلمة المرور ">
                           </div>
                        </div>
                        <button id="learner_security_btn" class="btn btn-warning w-100 btn-create-acount my-4 text-light"> حفظ التغيرات  </button>

                   </div>
                  </form>
               </div>
         </div>
      </div>
      </section>
                </div>
              </div>
        </div>
</div>
</section>
<!-- end tab -->
@stop

@push('js')

<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
 
<script>
$('.deletem_b').on("click", function (e) {
            e.preventDefault();
               
         var id = $(this).attr('deletem_b');
         
         
         $.ajax({
                type: "post",
                url: "{{ route('delete_address') }}",
                data: { _token: '{{ csrf_token() }}',
                     "id" : id },
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                        $(".R_address"+ data.id).remove();
                        flashBox('success', ' تم الحذف');

                    },
                    error: function (err) {
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            $('#success_message_notifications').fadeIn().html('<div class="alert alert-danger border-0 alert-dismissible">' + err.responseJSON.message +'</div>');


                        }
                    }
                });   
          
    });
    

    $('.deletem_order').on("click", function (e) {
            e.preventDefault();
            
        if (confirm("هل انت متأكد من الغاء الطلب") == true) {

         var id = $(this).attr('deletem_order');
         
         
         $.ajax({
                type: "post",
                url: "{{ route('delete_order') }}",
                data: { _token: '{{ csrf_token() }}',
                     "id" : id },
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                        $(".R_order"+ data.id).remove();
                        flashBox('success', ' تم الحذف');

                    },
                    error: function (err) {
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            $('#success_message_notifications').fadeIn().html('<div class="alert alert-danger border-0 alert-dismissible">' + err.responseJSON.message +'</div>');


                        }
                    }
                });   
              }
    });


$('#learner_security_btn').on('click' , function (e) {
            e.preventDefault();
            $(document).find('#err').remove();
            $.ajax({
                type: "post",
                url: "{{ route('user.settings_security.save') }}",
                data: $("#learner_security").serialize(),
                dataType: 'json',              // let's set the expected response format
                success: function (data) {
                    //console.log(data);
                    flashBox('success', 'تم تحديث البيانات');

                     
                },
                error: function (err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        $('#success_message_security').fadeIn().html('<div class="alert alert-danger border-0 alert-dismissible"> تأكد من البيانات المدخلة</div>');
                        document.body.scrollTop = document.documentElement.scrollTop = 0;

                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            //el.nextAll().remove();
                            el.after($(' <div id="err" class="input-group"><span  style="color: red;">' + error[0] + '</span> </div>'));
                        });
                    }
                }
            });

        });



 </script>
@endpush
