@extends('layouts.layoutSite.SitePage')
 

@section('content')
 <!-- start breadcrumb -->

<section class="section-breadcrumb p-2">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('viewHomePage')}}">الرئيسية</a></li>
                  <li class="breadcrumb-item active" aria-current="page">سلة المشتريات</li>
                </ol>
              </nav>
        </div>
    </div>
</section>
<!-- end breadcrumb -->

<section class="container">
    <div class="row">
<div class="col-lg-8">
 @if($cart->get()->count()== 0 ) <h1>  السلة فارغة</h1><br><a href="{{route('viewHomePage')}}">الرئيسية</a>   @else
    @foreach($cart->get() as $item)
    <div class="d-sm-flex  product-in-cart align-items-center" id="{{ $item->id }}">
        
        <div class="item product-in-cart-image">
        <a href="{{route('viewProperty',$item->product->id)}}">
<img src="{{asset('/storage/property/'.$item->product->image)}}" alt="image for product"></a>
             
        </div>
        <div class="item product-in-cart-title flex-fill text-start">
        <p> {{ $item->name }}</p>
        </div>
        <div class="item product-in-cart-quantity">
            <div class="d-flex quantity-of-product" role="group" aria-label="Basic example">
                <button type="button" class="btn bi bi-dash"></button>
 
                <input type="text" class="btn btn-quantity-product item-quantity" readonly product_id="{{$item->product->id}}" dataa_id="{{ $item->id }}" dataa_total="{{ $item->quantity * $item->product->price }}" dataa_price="{{ $item->product->price }}"  value="{{ $item->quantity }}">

                 <button type="button" id="plus{{$item->id}}" class="btn bi bi-plus"></button>
              </div>
        </div>x
        <div class="item product-in-cart-sum" id="price{{ $item->id }}">
            <sapn id="tprice{{$item->id }}">@if($item->product->price_alternative) {{  $item->product->price_alternative }} @else {{  $item->product->price }} @endif</sapn>
            د.ك
        </div>
        <div class="item product-in-delete">
            <button class="btn bi bi-trash border-0 remove-item" data_id="{{ $item->id }}"  href="javascript:void(0)"></button>
        </div>
            </div>
            @endforeach
            

                    <div class="d-md-flex discount-code justify-content-between">
                     
                    <a href="/cartempty" onclick="confirm('هل انت متاكد من افراغ السلة!');">
                    <button class="btn btn-outline-dark btn-refresh-cart">افراغ السلة</button></a>
                    </div>
</div>

<div class="col-lg-4">

<div class="cart-sum my-5 my-md-2">
<p class="my-3 text-center">مجموع السلة</p>
<hr>
<div class="d-flex justify-content-between">
    <span>المجموع الجزئي</span>
    <div id="totalq1">
            <span id="totals1">{{$cart->total()}}</span>
            د.ك
    </div>
</div>
<hr>
<form id="contact-form" action="{{route('indexorder')}}" method="get">
   @csrf
@if(Auth::user())
<div class="d-flex justify-content-between">
    <span>الشحن</span>
    <div>
        <select name="address_id" class="form-select select-choose-region" aria-label="Default select example" >
            <option value="" selected>اختر المنطقة</option>
  @foreach(\Illuminate\Support\Facades\Auth::user()->addresses as $address)

            <option value="{{$address->id}}">{{$address->name}} / {{$address->area}}</option>
         
            @endforeach
          </select>
 
    </div>
</div>
    <hr>
    @endif
    <div class="d-flex justify-content-between">
        <span>المجموع الكلي</span>
        <div id="totalq">
            <span id="totals">{{$cart->total()}}</span>
            د.ك
        </div>
    </div>
    


<button class="btn btn-warning w-100 my-3 mt-4 continue-buying" type="submit">المتابعة لاتمام الشراء</button>
</form>
@endif
</div>
</div>
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
              var product_id = $(this).attr('product_id');
         var total = $(this).attr('dataa_total') + $(this).attr('dataa_price');
         

         
         $.ajax({
                type: "post",
                url: "/cart/" + id,
                method: "put",
                data: { _token: '{{ csrf_token() }}',
                quantity: $(this).val(),
                product_id: product_id,
                xx: 'x',
                     },
                               // let's set the expected response format
                    success: function (data) {
                        if(data.message == 1){
                              
                            flashBox('error', 'نفذت الكمية');


                        }else{
                            $("#totals").remove();
                        $("#totalq").fadeIn().html( '<span id="totals">' + data.totalx +'</span> د.ك' );
                        $("#totals1").remove();
                        $("#totalq1").fadeIn().html( '<span id="totals1">' + data.totalx +'</span> د.ك' );
                   
                        }
                         
 
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

