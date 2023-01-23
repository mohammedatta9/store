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
                  <li class="breadcrumb-item active" aria-current="page"> {{$category->name}} </li>
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
        <div class="clearfix">
            <p class="h2 mb-3 float-start">  {{$category->name}}  </p>
            <div class="float-end">
                <button class="btn btn-sort-by"  data-bs-toggle="offcanvas" href="#canvas-sort-by" role="button" aria-controls="offcanvasExample">
                    <span class="bi bi-funnel"></span>
                    فرز حسب 
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="canvas-sort-by" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header clearfix">
                      <button type="button" class="btn btn-close-it border-0 bi bi-x-circle float-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        
<div class="accordion accordion-flush" id="accordionFlushExamplezz">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          فرز حسب السعر
      </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <form action="{{route('searcha_property')}}" method="get" enctype="multipart/form-data">
      <div class="accordion-body">
              <div class="form-check sort-by-range">
                  <input class="form-check-input invisible" type="radio" name="range" value="1" id="sort-by-range1">
                  <label class="form-check-label" for="sort-by-range1">
                      <span>5</span>
                      <bdi>.دك</bdi><span class="p-3">-</span>
                      <span>15</span>
                      <bdi>.دك</bdi>
                  </label>
                </div>
                <div class="form-check sort-by-range">
                  <input class="form-check-input invisible" type="radio" name="range" value="2" id="sort-by-range2">
                  <label class="form-check-label" for="sort-by-range2">
                      <span>15</span>
                      <bdi>.دك</bdi><span class="p-3">-</span>
                      <span>30</span>
                      <bdi>.دك</bdi>
                  </label>
                </div>
                <div class="form-check sort-by-range">
                  <input class="form-check-input invisible" type="radio" name="range" value="3" id="sort-by-range3">
                  <label class="form-check-label" for="sort-by-range3">
                      <span>30</span>
                      <bdi>.دك</bdi><span class="p-3">-</span>
                      <span>45</span>
                      <bdi>.دك</bdi>
                  </label>
                </div>
                <div class="form-check sort-by-range">
                  <input class="form-check-input invisible" type="radio" name="range" value="4" id="sort-by-range4">
                  <label class="form-check-label" for="sort-by-range4">
                      <span>45</span>
                      <bdi>.دك</bdi><span class="p-3">-</span>
                      <span>60</span>
                      <bdi>.دك</bdi>
                  </label>
                </div>
          </div>    
          </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
          الكلمة المفتاحية 
            </button>
      </h2>
      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            @foreach($categories as $category)
            <div class="form-check sort-by-range">
                            <input class="form-check-input invisible" type="radio" name="category" value="{{$category->id}}" id="radio-add-accessories-0{{$category->id}}">
                     <label class="form-check-label" for="radio-add-accessories-0{{$category->id}}">
                  
                     <span>{{$category->name}}</span>
                  </label>
                </div>
                @endforeach 
          </div>
          </div>
    </div><button type="submit" class="btn ">إرسال</button>
</form>
  </div>
                    </div>
                  </div>
            </div>
        </div>
        @if( $products->count() == 0 ) <h3 class="mb-30"> لا يحتوي هذا القسم على سلع حاليا.</h3>@endif

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
                    <button id="cart{{$product->id}}" class="btn bi btn-cart add_cart bi-cart-fill" product_id="{{$product->id}}"></button>
                        <button  @if(Auth::user()) @if( Auth::user()->like->where('property_id', $product->id)->first() )class="liked btn bi btn-heart bi-heart-fill action" @else class="liked btn bi bi-heart btn-heart " @endif  @else class=" btn bi bi-heart btn-heart " @endif  property="{{$product->id}}" value="1" name="like" id="like"></button>
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
         @if (isset($products) && $products->lastPage() > 1)
  <ul class="pagination justify-content-center">
    @php
      $interval = isset($interval) ? abs(intval($interval)) : 3 ;
      $from = $products->currentPage() - $interval;
      if($from < 1){
        $from = 1;
      }

      $to = $products->currentPage() + $interval;
      if($to > $products->lastPage()){
        $to = $products->lastPage();
      }
    @endphp
    <!-- first/previous -->
    @if($products->currentPage() > 1)
 
    <li class="page-item ">
      <a href="{{ $products->url(1) }}" class="page-link"   >
      <span >&laquo;</span>
      </a>
    </li> 
    <li class="page-item ">
      <a href="{{ $products->url($products->currentPage() - 1) }}"  class="page-link">
      <span >&lsaquo;</span>
      </a>
    </li>
    @endif
    <!-- links -->
    @for($i = $from; $i <= $to; $i++)
    @php
      $isCurrentPage = $products->currentPage() == $i;
    @endphp
    <li class="page-item {{ $isCurrentPage ? 'active ' : '' }}" aria-current="{{ $isCurrentPage ? 'page ' : '' }}">
      <a href="{{ !$isCurrentPage ? $products->url($i) : '#' }}" class="page-link">
      {{ $i }}
      </a>
    </li>
    @endfor
    <!-- next/last -->
    @if($products->currentPage() < $products->lastPage())
    <li class="page-item ">
      <a href="{{ $products->url($products->currentPage() + 1) }}" class="page-link" >
      <span >&rsaquo;</span>
      </a>
    </li>
    <li class="page-item ">
      <a href="{{ $products->url($products->lastpage()) }}" class="page-link">
      <span >&raquo;</span>
      </a>
    </li>
    @endif
  </ul>
@endif 
          </nav>
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

