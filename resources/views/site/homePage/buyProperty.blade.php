@extends('layouts.layoutSite.SitePage')
@section('title','عقارات للبيع')
@section('content')


    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="{{asset('SitePage/img/bg/14.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">شراء عقارات</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> الصفحة الرئيسية</a></li>
                                <li>شراء عقارات</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-lg-2 mb-100">
                    <div class="ltn__shop-options">
                        <ul class="justify-content-start">
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="active show" data-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                        <a data-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                             
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Search Widget -->
                                        <div class="ltn__search-widget mb-30">
                                            <form action="#">
                                                <input type="text" name="search" placeholder="Search your keyword...">
                                                <button type="submit"><i class="fas fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    @foreach($properties as $property)
                                        <div class="col-xl-6 col-sm-6 col-12">
                                            <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                                                <div class="product-img">
                                                    <a href="{{route('viewProperty',$property->id)}}"><img width="368px" height="282px" src="{{asset('/storage/property/'.$property->main_image)}}" alt="{{$property->title}}"></a>
                                                     
                                                </div>
                                                <div class="product-info">
                                                    <div class="product-badge">
                                                        <ul>
                                                            <li class="sale-badg">{{$property->type->name}}</li>
                                                        </ul>
                                                    </div>
                                                    <h2 class="product-title"><a href="{{route('viewProperty',$property->id)}}">{{$property->title}}</a></h2>
                                                    <div class="product-img-location">
                                                        <ul>
                                                            <li>
                                                                <a href="{{route('viewProperty',$property->id)}}"><i class="flaticon-pin"></i> {{$property->country->name}},{{$property->city->name}}</a>
                                                            </li> 
                                                        </ul>
                                                    </div>
                                                    <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                                       
                                                        <li><span>{{$property->space}} </span>
                                                            متر مربع
                                                        </li>
                                                    </ul>
                                                    <div class="product-hover-action">
                                                        <ul>
                                                            <li>
                                                                <a href="shop-left-sidebar.html#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal{{$property->id}}">
                                                                    <i class="flaticon-expand"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                
                                                           <input type="checkbox" class="liked" property="{{$property->id}}" value="1" name="like" id="like"@if(Auth::user()) @if( Auth::user()->like->where('property_id', $property->id)->first() )checked @endif  @endif > 
                                                                
                                                            </li>
                                                            <li>
                                                                <a href="{{route('viewProperty',$property->id)}}" title="Product Details">
                                                                    <i class="flaticon-add"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-info-bottom">
                                                    <div class="product-price">
                                                        <span>{{$property->price}} <label> {{$property->currency->name}} </label> {{$property->price_description}}</span>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL AREA START (Quick View Modal) -->
                                        <div class="ltn__modal-area ltn__quick-view-modal-area">
                                            <div class="modal fade" id="quick_view_modal{{$property->id}}" tabindex="-1">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                <!-- <i class="fas fa-times"></i> -->
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="ltn__quick-view-modal-inner">
                                                                <div class="modal-product-item">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-12">
                                                                            <div class="modal-product-img">
                                                                                <img src="{{asset('/storage/property/'.$property->main_image)}}" alt="#">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-12">
                                                                            <div class="modal-product-info">
                                                                                 
                                                                                <h3><a href="product-details.html">{{$property->title}}</a></h3>
                                                                                <div class="product-price">
                                                                                <span>{{$property->price}} <label> {{$property->currency->name}} </label> {{$property->price_description}}</span>  
                                                                                </div>
                                                                                <hr>
                                                                                <div class="modal-product-brief">
                                                                                    <p> {{$property->description}}</p>
                                                                                </div>
                                                                                <div class="modal-product-meta ltn__product-details-menu-1 d-none">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <strong>{{$property->type->name}}</strong>
                                                                                            
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                
                                                                                <!-- <hr> -->
                                                                                <div class="ltn__product-details-menu-3">
                                                                                    <ul>
                                                                                        <li>
                                                                                                  
                                                                                                <span>{{$property->type->name}}</span>
                                                                                           
                                                                                        </li>
                                                                                        
                                                                                    </ul>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="ltn__social-media">
                                                                                    <ul>
                                                                                        <li>Share:</li>
                                                                                        <li><a href="index.html#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                                                        <li><a href="index.html#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                                                        <li><a href="index.html#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                                                        <li><a href="index.html#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                                                                                    </ul>
                                                                                </div> 
                                                                                <label class="float-right mb-0"><a class="text-decoration" href="{{route('viewProperty',$property->id)}}"><small>View Details</small></a></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- MODAL AREA END -->
                                @endforeach
                                <!--  -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="liton_product_list">
                            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Search Widget -->
                                        <div class="ltn__search-widget mb-30">
                                            <form action="#">
                                                <input type="text" name="search" placeholder="Search your keyword...">
                                                <button type="submit"><i class="fas fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    @foreach($properties as $property)
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                                            <div class="product-img">
                                                <a  href="{{route('viewProperty',$property->id)}}"><img src="{{asset('/storage/property/'.$property->main_image)}}" alt="{{$property->title}}"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-badge-price">
                                                    <div class="product-badge">
                                                        <ul>
                                                            <li class="sale-badg">{{$property->type->name}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>{{$property->price}} {{$property->currency->name}}<label>/{{$property->price_description}}</label></span>
                                                    </div>
                                                </div>
                                                <h2 class="product-title"><a href="{{route('viewProperty',$property->id)}}">{{$property->title}}</a></h2>
                                                <div class="product-img-location">
                                                    <ul>
                                                        <li>
                                                            <a href="locations.html"><i class="flaticon-pin"></i>{{$property->country->name}} , {{$property->city->name}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                                    
                                                    <li><span> {{$property->space}} </span>
                                                       متر مربع
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-info-bottom">
                                                 
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="shop-left-sidebar.html#" title="Quick View" data-toggle="modal" data-target="#quick_view_modalq{{$property->id}}">
                                                                <i class="flaticon-expand"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                            <input type="checkbox" class="liked" property="{{$property->id}}" value="1" name="like" id="like"@if(Auth::user()) @if( Auth::user()->like->where('property_id', $property->id)->first() )checked @endif  @endif > 
                                                        </li>
                                                        <li>
                                                            <a href="{{route('viewProperty',$property->id)}}" title="Product Details">
                                                                <i class="flaticon-add"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- MODAL AREA START (Quick View Modal) -->
                                    <div class="ltn__modal-area ltn__quick-view-modal-area">
                                            <div class="modal fade" id="quick_view_modalq{{$property->id}}" tabindex="-1">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                <!-- <i class="fas fa-times"></i> -->
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="ltn__quick-view-modal-inner">
                                                                <div class="modal-product-item">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-12">
                                                                            <div class="modal-product-img">
                                                                                <img src="{{asset('/storage/property/'.$property->main_image)}}" alt="#">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-12">
                                                                            <div class="modal-product-info">
                                                                                 
                                                                                <h3><a href="product-details.html">{{$property->title}}</a></h3>
                                                                                <div class="product-price">
                                                                                <span>{{$property->price}} <label> {{$property->currency->name}} </label> {{$property->price_description}}</span>  
                                                                                </div>
                                                                                <hr>
                                                                                <div class="modal-product-brief">
                                                                                    <p> {{$property->description}}</p>
                                                                                </div>
                                                                                <div class="modal-product-meta ltn__product-details-menu-1 d-none">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <strong>{{$property->type->name}}</strong>
                                                                                            
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                
                                                                                <!-- <hr> -->
                                                                                <div class="ltn__product-details-menu-3">
                                                                                    <ul>
                                                                                        <li>
                                                                                                  
                                                                                                <span>{{$property->type->name}}</span>
                                                                                           
                                                                                        </li>
                                                                                        
                                                                                    </ul>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="ltn__social-media">
                                                                                    <ul>
                                                                                        <li>Share:</li>
                                                                                        <li><a href="index.html#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                                                        <li><a href="index.html#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                                                        <li><a href="index.html#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                                                        <li><a href="index.html#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                                                                                    </ul>
                                                                                </div> 
                                                                                <label class="float-right mb-0"><a class="text-decoration" href="{{route('viewProperty',$property->id)}}"><small>View Details</small></a></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- MODAL AREA END -->
                                    @endforeach
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                        @if (isset($properties) && $properties->lastPage() > 1)
  <ul>
    @php
      $interval = isset($interval) ? abs(intval($interval)) : 3 ;
      $from = $properties->currentPage() - $interval;
      if($from < 1){
        $from = 1;
      }

      $to = $properties->currentPage() + $interval;
      if($to > $properties->lastPage()){
        $to = $properties->lastPage();
      }
    @endphp
    <!-- first/previous -->
    @if($properties->currentPage() > 1)
 
    <li>
      <a href="{{ $properties->url(1) }}" aria-label="First">
      <span aria-hidden="true">&laquo;</span>
      </a>
    </li> 
    <li>
      <a href="{{ $properties->url($properties->currentPage() - 1) }}" aria-label="Previous">
      <span aria-hidden="true">&lsaquo;</span>
      </a>
    </li>
    @endif
    <!-- links -->
    @for($i = $from; $i <= $to; $i++)
    @php
      $isCurrentPage = $properties->currentPage() == $i;
    @endphp
    <li class="{{ $isCurrentPage ? 'active' : '' }}">
      <a href="{{ !$isCurrentPage ? $properties->url($i) : '#' }}">
      {{ $i }}
      </a>
    </li>
    @endfor
    <!-- next/last -->
    @if($properties->currentPage() < $properties->lastPage())
    <li>
      <a href="{{ $properties->url($properties->currentPage() + 1) }}" aria-label="Next">
      <span aria-hidden="true">&rsaquo;</span>
      </a>
    </li>
    <li>
      <a href="{{ $properties->url($properties->lastpage()) }}" aria-label="Last">
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    @endif
  </ul>
@endif 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  mb-100">
                    <aside class="sidebar ltn__shop-sidebar">
                        <h3 class="mb-10">معلومات العقارات</h3>
                        <label class="mb-30"><small>{{$properties->count()}} عقارات  </small></label>
                        <!-- Advance Information widget -->
                        <div class="widget ltn__menu-widget">
                        <h4 class="ltn__widget-title">نوع العقار</h4>
                            <ul>
                                @foreach($types as $type)
                                <li>
                                <!-- checked="checked" -->
                                    <label class="checkbox-item">{{$type->name}}
                                        <input type="checkbox" >
                                        <span class="checkmark"></span>
                                    </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                @endforeach
                                 
                            </ul>
                            <hr>
                            <h4 class="ltn__widget-title">وسائل الراحة و الميزات</h4>
                            <ul>
                                <li>
                                <label class="checkbox-item">ماء
                                                <input type="checkbox" name="amenities[]" value="ماء">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">كهرباء
                                                <input type="checkbox" name="amenities[]" value="كهرباء">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">صالة رياضة
                                                <input type="checkbox" name="amenities[]" value="صالة رياضة">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">مصلى
                                                <input type="checkbox" name="amenities[]" value="مصلى">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">خدمات صيانة
                                                <input type="checkbox" name="amenities[]" value="خدمات صيانة">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no">  </span>
                                </li>
                                <li>
                                <label class="checkbox-item">تلفون
                                                <input type="checkbox" name="amenities[]" value="تلفون">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">مصعد
                                                <input type="checkbox" name="amenities[]" value="مصعد">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">انترنت
                                                <input type="checkbox" name="amenities[]" value="انترنت">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">حماية نوافذ
                                                <input type="checkbox" name="amenities[]" value="حماية نوافذ">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">موقف سيارات
                                                <input type="checkbox" name="amenities[]" value="موقف سيارات">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">مكيف
                                                <input type="checkbox" name="amenities[]" value="مكيف">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">تدفئة
                                                <input type="checkbox" name="amenities[]" value="تدفئة">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                <li>
                                <label class="checkbox-item">طاقة شمسية
                                                <input type="checkbox" name="amenities[]" value="طاقة شمسية">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                
                                <li>
                                <label class="checkbox-item">مسموح للكلاب
                                                <input type="checkbox" name="amenities[]" value="مسموح للكلاب">
                                                <span class="checkmark"></span>
                                            </label>
                                    <span class="categorey-no"> </span>
                                </li>
                            </ul>
                            <hr>
                            
                            <hr>
                            <!-- Price Filter Widget -->
                            <div class="widget--- ltn__price-filter-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border---">السعر</h4>
                                <div class="price_filter">
                                    <div class="price_slider_amount">
                                        <input type="submit"  value="حدد مجال السعر  :"/>
                                        <input type="text" class="amount" name="price"  placeholder="ادخل السعر" />
                                    </div>
                                    <div class="slider-range"></div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="ltn__widget-title">تصنيف العقار</h4>
                            <ul>

                               @foreach($categories as $c)
                                <li>
                                <!-- checked="checked" -->
                                    <label class="checkbox-item">{{$c->name}}
                                        <input type="checkbox" >
                                        <span class="checkmark"></span>
                                    </label>
                                    <span class="categorey-no"> </span>
                                </li>
                                @endforeach
                            </ul>
                            <hr>
                        </div>
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget d-none">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                            <ul>
                                <li><a href="shop-left-sidebar.html#">Body <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="shop-left-sidebar.html#">Interior <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="shop-left-sidebar.html#">Lights <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="shop-left-sidebar.html#">Parts <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="shop-left-sidebar.html#">Tires <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="shop-left-sidebar.html#">Uncategorized <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="shop-left-sidebar.html#">Wheel <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            </ul>
                        </div>
                        <!-- Price Filter Widget -->
                        <div class="widget ltn__price-filter-widget d-none">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
                            <div class="price_filter">
                                <div class="price_slider_amount">
                                    <input type="submit"  value="Your range:"/>
                                    <input type="text" class="amount" name="price"  placeholder="Add Your Price" />
                                </div>
                                <div class="slider-range"></div>
                            </div>
                        </div>
                        <!-- Top Rated Product Widget -->
                        <div class="widget ltn__top-rated-product-widget d-none">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                            <ul>
                                <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img">
                                            <a href="product-details.html"><img src="{{asset('SitePage/img/product/1.png')}}" alt="#"></a>
                                        </div>
                                        <div class="top-rated-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h6><a href="product-details.html">Mixel Solid Seat Cover</a></h6>
                                            <div class="product-price">
                                                <span>$49.00</span>
                                                <del>$65.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img">
                                            <a href="product-details.html"><img src="{{asset('SitePage/img/product/2.png')}}" alt="#"></a>
                                        </div>
                                        <div class="top-rated-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h6><a href="product-details.html">Brake Conversion Kit</a></h6>
                                            <div class="product-price">
                                                <span>$49.00</span>
                                                <del>$65.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img">
                                            <a href="product-details.html"><img src="{{asset('SitePage/img/product/3.png')}}" alt="#"></a>
                                        </div>
                                        <div class="top-rated-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="fas fa-star-half-alt"></i></a></li>
                                                    <li><a href="shop-left-sidebar.html#"><i class="far fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h6><a href="product-details.html">Coil Spring Conversion</a></h6>
                                            <div class="product-price">
                                                <span>$49.00</span>
                                                <del>$65.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Search Widget -->
                        <div class="widget ltn__search-widget d-none">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
                            <form action="#">
                                <input type="text" name="search" placeholder="Search your keyword...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <!-- Tagcloud Widget -->
                        <div class="widget ltn__tagcloud-widget d-none">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Popular Tags</h4>
                            <ul>
                                <li><a href="shop-left-sidebar.html#">Popular</a></li>
                                <li><a href="shop-left-sidebar.html#">desgin</a></li>
                                <li><a href="shop-left-sidebar.html#">ux</a></li>
                                <li><a href="shop-left-sidebar.html#">usability</a></li>
                                <li><a href="shop-left-sidebar.html#">develop</a></li>
                                <li><a href="shop-left-sidebar.html#">icon</a></li>
                                <li><a href="shop-left-sidebar.html#">Car</a></li>
                                <li><a href="shop-left-sidebar.html#">Service</a></li>
                                <li><a href="shop-left-sidebar.html#">Repairs</a></li>
                                <li><a href="shop-left-sidebar.html#">Auto Parts</a></li>
                                <li><a href="shop-left-sidebar.html#">Oil</a></li>
                                <li><a href="shop-left-sidebar.html#">Dealer</a></li>
                                <li><a href="shop-left-sidebar.html#">Oil Change</a></li>
                                <li><a href="shop-left-sidebar.html#">Body Color</a></li>
                            </ul>
                        </div>
                        <!-- Size Widget -->
                        <div class="widget ltn__tagcloud-widget ltn__size-widget d-none">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product Size</h4>
                            <ul>
                                <li><a href="shop-left-sidebar.html#">S</a></li>
                                <li><a href="shop-left-sidebar.html#">M</a></li>
                                <li><a href="shop-left-sidebar.html#">L</a></li>
                                <li><a href="shop-left-sidebar.html#">XL</a></li>
                                <li><a href="shop-left-sidebar.html#">XXL</a></li>
                            </ul>
                        </div>
                        <!-- Color Widget -->
                        <div class="widget ltn__color-widget d-none">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product Color</h4>
                            <ul>
                                <li class="black"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="white"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="red"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="silver"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="gray"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="maroon"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="yellow"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="olive"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="lime"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="green"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="aqua"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="teal"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="blue"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="navy"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="fuchsia"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="purple"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="pink"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="nude"><a href="shop-left-sidebar.html#"></a></li>
                                <li class="orange"><a href="shop-left-sidebar.html#"></a></li>

                                <li><a href="shop-left-sidebar.html#" class="orange"></a></li>
                                <li><a href="shop-left-sidebar.html#" class="orange"></a></li>
                            </ul>
                        </div>
                        <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget d-none">
                            <a href="shop.html"><img src="{{asset('SitePage/img/banner/banner-2.jpg')}}" alt="#"></a>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->


@stop

@section('script')

<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="{{asset('SitePage/js/plugins.js')}}"></script>
<script src="{{asset('SitePage/js/main.js')}}"></script>

<script>
$('.liked').on("change", function (e) {
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
@stop
