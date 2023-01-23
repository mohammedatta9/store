@extends('layouts.layoutSite.SitePage')
@section('content')
 
<!-- start shop by category -->
<section class="shop-by-category py-4">
  <div class="container">
  <div class="row d-flex align-items-stretch">
    <p class="h2 mb-3">تسوق حسب الفئة</p>
<div class="col-x col-6 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
  <a href="/category_property/13" class="card">
    <p>سيستم الطاقة الشمسية</p>
    <img src="images/category01.png" alt="solar panel">
  </a>
</div>
<div class="col-x col-6 col-sm-6 col-md-4 col-lg-3 col-xxl-2 ">
  <a href="/category_property/8" class="card">
    <p>أجهزة الطاقة الشمسية</p>
    <img src="images/category02.png" alt="solar panel">
  </a>
</div>
<div class="col-x col-6 col-sm-6 col-md-4 col-lg-3 col-xxl-2 ">
  <a href="/category_property/9" class="card">
    <p>الكشافات</p>
    <img src="images/category03.png" alt="solar panel">
  </a>
</div>
<div class="col-x col-6 col-sm-6 col-md-4 col-lg-3 col-xxl-2 ">
  <a href="/category_property/10" class="card">
    <p>الإنارات</p>
    <img src="images/category04.png" alt="solar panel">
  </a>
</div>
<div class="col-x col-6 col-sm-6 col-md-4 col-lg-3 col-xxl-2 ">
  <a href="/category_property/11" class="card">
    <p>مولدات كهربائية</p>
    <img src="images/category05.png" alt="solar panel">
  </a>
</div>
<div class="col-x col-6 col-sm-6 col-md-4 col-lg-3 col-xxl-2 ">
  <a href="/category_property/12" class="card">
    <p>قسم متنوع</p>
    <img src="images/category06.png" alt="solar panel">
  </a>
</div>
  </div>
</div>
</section>
<!-- end shop by category -->

<!-- start carousel -->
<article class="container py-5">
  <div class="owl-carousel  owl-theme main-carousel row">
  
  @foreach($carousels as $carousel)
  <div class="item">
    <img src="{{asset('/storage/property/'.$carousel->image)}}"  alt="background for carousel">
  <div class="main-carousel-card d-flex align-items-center p-5 text-md-start text-center">
    <div>
    <p class="card-title h4 mb-4">{{$carousel->title}}</p>
    <p class="card-text h1 mb-5"> {{$carousel->text}}</p>
    <button class="btn btn-warning btn-shop-now text-light rounded rounded-4 p-2 px-3">تسوق الأن</button>
  </div>
  </div>
  <div class="carousel-notic"></div>
  
  </div>@endforeach
</div>
</article>
<!-- end carousel -->
<!-- start discount -->
<article class="section-discount p-3">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="part-discount">
          <div class="the-dicount"><span>-50%</span></div>
          <p class="text-orange-color mb-3">خصم لفترة محدودة</p>
          <bold class="h2">على قسم الأجهزة</bold>
          <div class="clear-fix mt-2">
            <p class="float-start text-secondary">تسوق الأن بخصومات تصل 
            <br>
              الى<span>50%</span></p>
              <button class="btn btn-warning btn-shop-now text-light rounded rounded-4 float-end">تسوق الأن</button>

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="part-discount">
          <div class="the-dicount"><span>-50%</span></div>
          <p class="text-orange-color mb-3">خصم لفترة محدودة</p>
          <bold class="h2">على قسم الأجهزة</bold>
          <div class="clear-fix mt-2">
            <p class="float-start text-secondary">تسوق الأن بخصومات تصل 
            <br>
              الى<span>50%</span></p>
              <button class="btn btn-warning btn-shop-now text-light rounded rounded-4 float-end">تسوق الأن</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</article>
<!-- end discount -->
<!-- start services -->
<section class="section-services p-4">
<div class="container">
  <div class="row d-flex align-items-stretch">
    <div class="col-sm-6 col-lg-4 col-xl-3">
      <div class="part-services d-flex p-3">
<img src="images/services01.png" class="float-start img-services align-self-start" alt="">
<div class="float-end">
  <bold class="fw-bold">خدمة العملاء</bold>
  <p class="text-secondary">نحن متواجدون على واتساب/ فيسبوك او تلفون لمساعدتك
    </p>
</div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3">
      <div class="part-services d-flex p-3">
<img src="images/services02.png" class="float-start img-services align-self-start" alt="">
<div class="float-end">
  <bold class="fw-bold">الدفع عبر الإنترنت بطريقة امنة جدا

  </bold>
  <p class="text-secondary">خدمة الدفع أمنه<span>100%</span>
  </p>
</div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3">
      <div class="part-services d-flex p-3">
<img src="images/services03.png" class="float-start img-services align-self-start" alt="">
<div class="float-end">
  <bold class="fw-bold">خدمة التوصيل</bold>
  <p class="text-secondary">يتم تسليم جميع الطلبات في اقرب وقت
    </p>
</div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3">
      <div class="part-services d-flex p-3">
<img src="images/services04.png" class="float-start img-services align-self-start" alt="">
<div class="float-end">
  <bold class="fw-bold">منتجات فريدة</bold>
  <p class="text-secondary">لدينا العديد من المنتجات المختلفة
    </p>
</div>
      </div>
    </div>
  </div>
 
</div>
</section>
<!-- end services -->

@stop
 