@extends('layouts.layoutSite.SitePage')
@section('title','نتائج البحث')
@section('content')

 
<!-- start breadcrumb -->

<section class="section-breadcrumb p-2">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">الرئيسية</a></li>
                  <li class="breadcrumb-item active" aria-current="page">  المفضلة</li>
                </ol>
              </nav>
        </div>
    </div>
</section>
<!-- end breadcrumb -->

<!-- start boards -->
<section class="section-boards py-3">
<div class="container">
    <div class="row">
    @if(Auth::user())
        @if( Auth::user()->like->count() == 0) <h3 class="mb-30"> لا يوجد منتجات بالمفضلة حاليا</h3>@endif

        @foreach(Auth::user()->like as $like)
        @if($like->product)
        <div class="col-x col-sm-6 col-md-4 col-lg-3 col-xxl-2">
            <div class="card-product p-3">     
            <a href="{{route('viewProperty',$like->product->id)}}">  <h6 class="card-title"> {{$like->product->name}}</h6></a>
                <div class="product-contain">
                <a href="{{route('viewProperty',$like->product->id)}}">
<img src="{{asset('/storage/property/'.$like->product->image)}}" alt="image for product"></a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-end">
                    <div>
                    <button id="cart{{$like->product->id}}" class="btn bi btn-cart add_cart bi-cart-fill" product_id="{{$like->product->id}}"></button>
                        <button  @if(Auth::user()) @if( Auth::user()->like->where('property_id', $like->product->id)->first() )class="liked btn bi btn-heart bi-heart-fill action" @else class="liked btn bi bi-heart btn-heart " @endif  @endif  property="{{$like->product->id}}" value="1" name="like" id="like"></button>
                    </div>
                    <div>
                        @if($like->product->price_alternative)
                        <del class="d-block"><sapn>{{$like->product->price}}</span>. دك</del>
                        <span class="d-block"><sapn>{{$like->product->price_alternative}}</sapn>د.ك</span> 
                        @else
                        <span class="d-block"><sapn>{{$like->product->price}}</sapn>د.ك</span>   
                        @endif   
                    </div>
                </div>
              </div>
        </div>
        @endif
       @endforeach
          </nav>
          @endif
    </div>
</div>
</section>

 <!-- end boards -->
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
    
$('.add_cart').on("click", function (e) {
            e.preventDefault();
               
         var id = $(this).attr('product_id');
         
         
         $.ajax({
                type: "post",
                url: "{{ route('cart.store') }}",
                data: { _token: '{{ csrf_token() }}',
                     "product_id" : id,
                     "quantity" : 1},
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                        // $("#cart"+ id).remove();
                        flashBox('success', 'تمت الاضافة الى السلة');

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

