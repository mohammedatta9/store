@extends('layouts.layoutSite.SitePage')
 @section('content')


        <!-- start breadcrumb -->

        <section class="section-breadcrumb p-2">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('viewHomePage')}}">الرئيسية</a></li>
                  @if($product->category)<li class="breadcrumb-item"><a href="/category_property/{{$product->category_id}}"> {{$product->category->name}} </a></li>@endif
                  <li class="breadcrumb-item active" aria-current="page"> {{$product->name}} </li>
                </ol>
              </nav>
        </div>
    </div>
</section>
<!-- end breadcrumb -->

<section class="container section-details-panel">
<div class="row">
    <!-- start carousel -->
    <div class="col-md-7">

        <div class="owl-carousel owl-theme carousel-panels p-2 m-2">
            <div class="item" data-hash="carousel-panels-001"><img src="{{asset('/storage/property/'.$product->image)}}" alt="panel image"></div> 
            @foreach($product->album as $a) 
            <div class="item" data-hash="carousel-panels-0{{$a->id}}"><img src="{{asset('/storage/property/'.$a->name)}}" alt="panel image"></div>
  
               @endforeach
        </div>
        <div class="hash-carousel p-2 m-2">
            <a class="item active" href="#carousel-panels-001"><img src="{{asset('/storage/property/'.$product->image)}}" alt="panel image"></a>
            @foreach($product->album as $a)   
                     <a class="item" href="#carousel-panels-0{{$a->id}}"><img src="{{asset('/storage/property/'.$a->name)}}" alt="panel image"></a>
              @endforeach
             
        </div>

    </div>
    <!-- end carousel -->
    <!-- start details -->
    <div class="col-md-5 my-4">
        <p class="h5">{{$product->name}}</p>
        <div class="section-details-panel">
        @if($product->price_alternative)
                <span><sapn>{{$product->price_alternative}}</sapn> د.ك</span> 
                <del><sapn>{{$product->price}}</span>د.ك</del>  
                @else
                <span"><sapn>{{$product->price}}</sapn>د.ك</span>   
                @endif  
                
        </div>
        <hr>
        <p>الوصف</p>
        <p class="text-secondary"> {{$product->description}}</p>
 
             
            <p>اللون :<span class="product-color" > </span></p>
<form action="">
@foreach($product->color as $a)  
            
              <div class="form-check radio-product-color" data-product-color="{{$a->color}}" style="background-color:{{$a->color}}">
                <input class="form-check-input invisible" type="radio" name="radio-product-color" value="{{$a->color}}" id="radio-product-color-0{{$a->id}}" style="colorbackground:{{$a->color}}" >
                <label  style="color:{{$a->color}}"> color 
                </label>
              </div>
              @endforeach
              
             
</form>
<p>الحجم :<span>{{$product->size}}</span></p>
<bold>اضافة ملحقات</bold>
<form action="">
@foreach($product->option as $a) 
<div class="form-check radio-add-accessories">
    <input class="form-check-input invisible" type="radio" name="radio-add-accessories" id="radio-add-accessories-01"  checked>
    <label class="form-check-label" for="radio-add-accessories-0{{$a->id}}">
    {{$a->name}} ( {{$a->price}} دينار )
    </label>
  </div>
  @endforeach 
</form>
<br>
<form action="{{ route('cart.store') }}" method="post">
@csrf
<input type="hidden" name="product_id" value="{{ $product->id }}">

<div class="div-add-to-cart d-flex align-items-center">
    <div class="d-flex quantity-of-product" role="group" aria-label="Basic example">
        <button type="button" class="btn bi bi-dash"></button>
        <input type="text" value="1" name="quantity" class="btn btn-quantity-product" readonly>
        <button type="button" class="btn bi bi-plus"></button>
      </div>
      <button class="btn btn-add-to-cart" data-bs-toggle="modal" data-bs-target="#add-to-cart-modal">إضافة الى السلة</button>
      <button  @if(Auth::user()) @if( Auth::user()->like->where('property_id', $product->id)->first() )class="liked btn bi btn-heart bi-heart-fill action" @else class="liked btn bi bi-heart btn-heart " @endif  @endif  property="{{$product->id}}" value="1" name="like" id="like"></button>
</div>
</form>
<br>
<ul class="more-details">
    <li><span>SKU</span> : <span>{{$product->sku}}</span></li>
    <li><span>رمز السلعة</span> : <span>{{$product->code}}</span></li>
    <li><span>ضمان</span> : <span>{{$product->guarantee}}</span></li>
    <li><span>سومو</span> :<span> </span></li>
    <li> @if($product->category)<span>قسم {{$product->category->name}}</span> : @endif<span> {{$product->name}} </span></li>
    <li>مشاركة</li>
</ul>
<div class="socials-icons socials-icons-orange d-flex">
<a class="bi bi-facebook"></a>
<a class="bi bi-instagram"></a>
<a class="bi bi-whatsapp"></a>
</div>
</div>

     <!-- end details -->
</div>
</section>
<section class="section-related-products py-4">
    <div class="container">
    <div class="row">
        <p class="h5">منتجات مرتبطة</p>
        
        @foreach($products as $product)
       
        <div class="col-x col-sm-6 col-md-4 col-lg-3 col-xxl-2">
            <div class="card-product p-3">     
            <a href="{{route('viewProperty',$product->id)}}">  <h6 class="card-title"> {{$product->name}}</h6></a>
                <div class="product-contain">
                <a href="{{route('viewProperty',$product->id)}}">
<img src="{{asset('/storage/property/'.$product->image)}}" alt="image for product"></a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-end">
                    <div>
                        <button class="btn bi bi-cart btn-cart"></button>
                        <button  @if(Auth::user()) @if( Auth::user()->like->where('property_id', $product->id)->first() )class="liked btn bi btn-heart bi-heart-fill action" @else class="liked btn bi bi-heart btn-heart " @endif  @endif  property="{{$product->id}}" value="1" name="like" id="like"></button>
                    </div>
                    <div>
                        @if($product->price_alternative)
                        <del class="d-block"><sapn>{{$product->price}}</span>. دك</del>
                        <span class="d-block"><sapn>{{$product->price_alternative}}</sapn>د.ك</span> 
                        @else
                        <span class="d-block"><sapn>{{$product->price}}</sapn>د.ك</span>   
                        @endif   
                    </div>
                </div>
              </div>
        </div>
       @endforeach
    </div>
</div>
</section>
<div class="modal" id="add-to-cart-modal" tabindex="-2" aria-labelledby="add-to-cart-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
          <button type="button" class="btn btn-close-it border-0 bi bi-x-circle float-start" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
<div class="row py-4">
    <div class="col-6 text-center vl">
        <p class="text-center d-flex align-items-center justify-content-center">
<span class="bi bi-check"></span>
            تم تحديث الكمية بنجاح
        </p>
        <img src="images/panels04.png" class="my-2" width="50%" height="auto" alt="panel image">
        <ul class="more-details">
            <li><span>لوح طاقة شمسية</li>
            <li><span>الكمية</span> : <span>1</span></li>
            <li><span>المجموع</span> : <span>10</span>د.ك</li>   
        </ul>
    </div>
    <div class="col-6 text-center">
        <p>
            يوجد
            <span> 3</span>
             عنصر في سلة التسوق الخاصة بك
        </p>
        <p>
            <span>المجموع</span> : <span>30</span>د.ك
        </p>
        <button class="btn btn-outline-primary w-100 my-2">عرض سلة المشتريات</button>
        <button class="btn btn-primary w-100 my-2">المتابعة لإتمام الشراء</button>
    </div>
</div>
            
        </div>
      </div>
    </div>
  </div>

@stop

@push('js') 

  <script>
$('.liked').click(function(anyothername) {
              //  e.preventDefault();
               
         var id = $(this).attr('property');
         var val = $(this).val();
         
         $.ajax({
                type: "post",
                url: "{{ route('property.like') }}",
                data: { _token: '{{ csrf_token() }}',
                     "id" : id 
                      },
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                         
                    },
                    error: function (err) {
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            $('#success_message_notifications').fadeIn().html('<div class="alert alert-danger border-0 alert-dismissible">' + err.responseJSON.message +'</div>');


                        }
                    }
                });   
          
    });
</script>
@endpush

