@extends('layouts.layoutSite.SitePage')
 

@section('content')

<!-- start breadcrumb -->

<section class="section-breadcrumb p-2">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                  <li class="breadcrumb-item active" aria-current="page">تتبع الطلب</li>
                </ol>
              </nav>
        </div>
    </div>
</section>
<!-- end breadcrumb -->

<section class="container section-order-details mb-5">
    <div class="row">
<p class="h5">
    تفاصيل الطلب
</p>
 
<br>

<ul class="order-details mt-4">
    <li>
        <span>رقم الطلب</span>
         : 
         <span class="order">#{{$order->id}}</span>
    </li>
    <li>
        <span>المجموع</span>
         : 
         <span class="order"><span>{{$order->items->count()}}</span>منتج </span>
         <span>{{$order->total}}</span>
         د.ك
    </li> <li>
        <span>حالة الطلب</span>
         : 
         <span class="order"> @if($order->status == 0) تم رفض الطلب @endif @if($order->status == 1) تم استلام الطلب @endif @if($order->status == 2) تم  شحن الطلب @endif</span>
    </li>
</ul>
<br>
<hr>

<div class="hs-horizontal-steps mt-4 mb-5">
    <ol class="horizontal-steps" id="horizontal-steps">
    
         <li class="horizontal-steps-item hs-passed @if($order->status == 1)hs-passed @endif "><p>تم استلام الطلب
            <br>
            <time datatime="22/10/2022">{{$order->created_at->format('d/m/Y')}}</time>
         </p>
       <div class="bi bi-check"></div>
        </li>
        <li class="horizontal-steps-item @if($order->status == 2)hs-passed @endif  "><p>الدفع
            <br>
            @if($order->payment_method == "cash")
            الدفع عند الاستلام
            @else
            البطاقة الإتمانية/بطاقة ماي فاتورة 
            @if($order->payment_status)
            رقم الفاتورة {{$order->payment_status}}
            @endif  @endif
        </p>
            <div class="bi bi-check"></div></li> 
        <li class="horizontal-steps-item @if($order->status == 2)hs-passed @endif "><p>تم الشحن
            
        </p>
        
            <div class="bi bi-truck"></div></li>
        <li class="horizontal-steps-item "><p>تم التوصيل</p>
            <div class="bi bi-house-door"></div>
        </li>
    </ol>
    </div>


    </div>
</section>


@stop

@push('js')   
    
    @endpush

