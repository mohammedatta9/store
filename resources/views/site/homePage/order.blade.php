@extends('layouts.layoutSite.SitePage')
 

@section('content')
<!-- start breadcrumb -->

<section class="section-breadcrumb p-2">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">الرئيسية</a></li>
                  <li class="breadcrumb-item active" aria-current="page">إتمام الشراء</li>
                </ol>
              </nav>
        </div>
    </div>
</section>
<!-- end breadcrumb -->
<section class="container py-3 section-continue">
    <div class="row">
        <div class="col-md-6 payment-details">
            <p class="h4">
                تفاصيل الدفع
            </p>
            <br>
            <form id="contact-form" action="{{route('storeorder')}}" method="post">
            @csrf
                <div class="mb-3">
                    <label for="full-name" class="form-label">الاسم كامل </label>
                    @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                    <input type="text" name="name" class="form-control" id="full-name" value="@if($add == 1) {{$address->name}} @else {{old('name')}} @endif" maxlength="100" required>
                  </div>
                  <div class="mb-3">
                    <label for="email-address" class="form-label">البريد الالكتروني</label>
                    @error('email')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                    <input type="email" name="email" class="form-control" id="email-address" value="@if($add == 1) {{$address->email}} @else {{old('email')}}  @endif" maxlength="100" required>
                  </div>
                  <div class="my-3">
                    <label for="choose-region" class="form-label">المنطقة</label>
                    @error('area')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                  <select name="area" class="form-select form-control" id="choose-region" aria-label="Default select example" maxlength="100" required >
                  <option value="">اختر منطقة</option>  
                  <option selected value="@if($add == 1) {{$address->area}} @else {{old('area')}} @endif">    @if($add == 1) {{$address->area}} @else {{old('area')}}  @endif </option>
                    @foreach($cities as $ca)
                    <option value="{{$ca->name}}"> {{$ca->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                    <label for="street"  class="form-label">الشارع</label>
                    @error('street')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                    <input type="text" name="street" class="form-control" id="street" placeholder="أدخل اسم الشارع" value="@if($add == 1) {{$address->street}} @else {{old('street')}} @endif" maxlength="100"   >
                  </div>
                  <div class="mb-3">
                    <label for="District" class="form-label">الجادة</label>
                    <input type="text" name="Blve" class="form-control" id="أدخل رقم الجادة" value="@if($add == 1) {{$address->Blve}} @else {{old('Blve')}}  @endif">
                  </div>
                  <div class="mb-3">
                    <label for="flat" class="form-label">شقة/منزل</label>
                    <input type="text" name="house" class="form-control" id="flat" placeholder="أدخل رقم/اسم الشقة/المنزل" value="@if($add == 1) {{$address->house}} @else {{old('house')}}  @endif" maxlength="100"  >
                  </div>
                  <div class="mb-3">
                    <label for="mobile-number" class="form-label">رقم الموبايل</label>
                    @error('phone')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                    <input type="text" name="phone" class="form-control" id="mobile-number" value="@if($add == 1) {{$address->phone}} @else {{old('phone')}}  @endif" maxlength="100" required>
                  </div> 
                  @if(Auth::user())@else
                  <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="make_user"  id="accept">
                    <label class="form-check-label" for="accept">
                        إنشاء حساب
                     </label>
                  </div>
                  <div class="mb-3">
                  <label for="user-password" class="form-label">كلمة المرور</label>
                      @error('password')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                        <div class="input-group">
                        <button type="button" class="btn btn-eye bi bi-eye"></button>
                        <input type="password" class="form-control" name="password" aria-label="user-password" aria-describedby="user-password">
                    </div></div>
                  <div class="mb-3">
                  <label for="user-password" class="form-label">تاكيد كلمة المرور</label>
                     @error('password_confirmation')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                    <div class="input-group">
                    <button type="button" class="btn btn-eye bi bi-eye"></button>
                    <input type="password" class="form-control" name="password_confirmation" aria-label="user-password" aria-describedby="user-password">
                    </div></div>
                    @endif
                  <div class="mb-3">
                    <label for="add-nots" class="form-label">ملاحظات مع الطلب</label>
                    <textarea class="form-control" name="nots" id="add-nots" cols="10" rows="5"></textarea>
                  </div>

                  <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" value="" id="accept-terms"  required >
                    <label class="form-check-label" for="accept-terms">
                        أوافق على الشروط والأحكام
                    </label>
                  </div>
           
        </div>
        <div class="col-md-6 do-you-have-discount-code mt-5 mt-md-0">
      
            
            <div class="cart-sum my-5">
                <p class="h5 my-3 text-center">سلة المشتريات</p>
                @foreach($cart->get() as $item)

                <div class="d-flex product-in-cart align-items-center">
                    <div class="item product-in-cart-image">
<a href="{{route('viewProperty',$item->product->id)}}">
<img src="{{asset('/storage/property/'.$item->product->image)}}" alt="image for product"></a>                    </div>
                    <div class="item product-in-cart-title flex-fill text-start">
                    <p> {{ $item->product->name }}</p>
                    </div> 
                        </div>
                        
               @endforeach
                <div class="d-flex justify-content-between mt-5">
                    <span>المجموع الجزئي</span>
                    <div>
                        <span>@if(isset($rate)) {{$cart->total() - ($cart->total() * $rate)}} @else  {{$cart->total()}}  @endif </span>
                        د.ك
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>الشحن</span>
                    <div>
                        <span>2</span>
                        د.ك
                    </div>
                </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>المجموع</span>
                        <bold>
                            <span>@if(isset($rate)) {{$cart->total() - ($cart->total() * $rate) + 2}} @else  {{$cart->total() + 2}}  @endif</span>
 
                            د.ك
                        </bold>
                    </div>
                    
                
                
                
                </div>
                
                <div class="mb-3 form-check">
                @error('payment_method')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                    <input name="payment_method" class="form-check-input" type="radio" checked value="cash" id="buy-cash" >
                    <label class="form-check-label" for="buy-cash">
                        <img src="images/cach.png" width="auto" height="20px" alt="buy cash">
                        نقدا عند التوصيل
                    </label>
                  </div>
                  <div class="mb-3 form-check">
                    <input name="payment_method" class="form-check-input" type="radio" value="check" id="buy-check">
                    <label class="form-check-label" for="buy-check">
<img src="images/chech.png" width="auto" height="20px" alt="buy cash">
                        ماي فاتورة
                    </label>
                  </div>
                  <input type="text" value="@if(isset($rate)) {{$cart->total() - ($cart->total() * $rate) + 2}} @else  {{$cart->total() + 2}}  @endif" name="total" style="display:none" >
                  <input type="text" value="@if(isset($rate)) {{$cart->total() * $rate}} @else 0 @endif" name="discount" style="display:none" >

                  <hr class="my-4 hr-blue">

                <input type="submit" class="btn btn-warning float-end submit-buying" value="تأكيد الطلب">

        </div> </form>
        @if(isset($rate))@else
        <label class="form-check-label" for="input-discount-code">
                لديك كود خصم؟
            </label>
          
            <p class="h4">
                كود الخصم
            </p>
          
         
            <div class="d-flex mt-2">
            <form id="contact-form" action="{{route('discount')}}" method="post">
            @csrf
            <input type="text" name="code" class="form-control input-discount-code me-2 ms-0" maxlength="100" required placeholder="أدخل كود الخصم" >
            <input type="text" name="address_id"  value="@if($add == 1) {{$address->id}} @else  @endif" maxlength="100"  style="display:none" >
                <button type="submit" class="btn btn-dark" >استخدام الكود</button>
                </form>
            </div>@endif
    </div>
</section>
@stop

@push('js')  
<script>   
     
   $('.remove-item').on("click", function (e) {
              //  e.preventDefault();
               
         var id = $(this).attr('data_id');
         
         
         $.ajax({
                type: "post",
                url: "/cart/" + id,
                method: "delete",
                data: { _token: '{{ csrf_token() }}'
                     },
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                        $("#"+ data.id).remove();
                        $("#totals").remove();
                        $("#totalq").fadeIn().html( '<span id="totals">' + data.totala +'</span> د.ك' );
                        $("#totals1").remove();
                        $("#totalq1").fadeIn().html( '<span id="totals1">' + data.totala +'</span> د.ك' );
                    },
                    error: function (err) {
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            $('#axaa').fadeIn().html('<div class="alert alert-danger border-0 alert-dismissible">' + err.responseJSON.message +'</div>');


                        }
                    }
                });   
          
    });

    
    $('.item-quantity').on("change", function (e) {
              //  e.preventDefault();
               
         var id = $(this).attr('dataa_id');
         var total = $(this).attr('dataa_total') + $(this).attr('dataa_price');
         

         
         $.ajax({
                type: "post",
                url: "/cart/" + id,
                method: "put",
                data: { _token: '{{ csrf_token() }}',
                quantity: $(this).val(),
                xx: 'x',
                     },
                               // let's set the expected response format
                    success: function (data) {
                         $("#totals").remove();
                        $("#totalq").fadeIn().html( '<span id="totals">' + data.totalx +'</span> د.ك' );
                        $("#totals1").remove();
                        $("#totalq1").fadeIn().html( '<span id="totals1">' + data.totalx +'</span> د.ك' );
                   
 
                    },
                    error: function (err) {
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            $('#axaa').fadeIn().html('<div class="alert alert-danger border-0 alert-dismissible">' + err.responseJSON.message +'</div>');


                        }
                    }
                });   
          
    });

    </script>
    
    @endpush

