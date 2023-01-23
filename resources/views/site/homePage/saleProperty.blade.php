@extends('layouts.layoutSite.SitePage')
@section('title','عقارات للبيع')
@section('content')

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="{{asset('SitePage/img/bg/14.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">أضف عقار</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span>الرئيسية</a></li>
                                <li>أضف عقار</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    
    <!-- APPOINTMENT AREA START -->
    <div class="ltn__appointment-area pt-115--- pb-120">
        <div class="container">
        @if(\session()->has('success'))
      <div class="alert alert-success col-sm-2">
      <button type="button" class="close" data-dismiss="alert">×</button>    
          {{ session()->get('success') }}
      </div>
  @endif
  @if(\session()->has('msg'))
      <div class="alert alert-warning col-sm-4">
      <button type="button" class="close" data-dismiss="alert">×</button>    
          {{ session()->get('msg') }}
      </div>
  @endif
  
  @if (\Session::has('error'))
    <div class="alert alert-danger border-0 alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">×</button>    
        {!! \Session::get('error') !!}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        تأكد من المعلومات المدخلة
    </div>
@endif
            <div class="row">
                <div class="col-lg-12">                    
                    <form action="{{route('save_property')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="ltn__tab-menu ltn__tab-menu-3 ltn__tab-menu-top-right-- text-uppercase--- text-center">
                            <div class="nav">
                                <a   href="#liton1">1. الوصف</a>
                                <a   href="#liton2" class="">2. الوسائط</a>
                                <a href="#liton3" class="">3. الموقع</a>
                                <a href="#liton4" class="">4. التفاصيل</a>
                                <a href="#liton5" class="">5. الاضافات</a>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class=" active show" id="liton1">
                                     <h6>وصف العقار</h6>
                                    <div class="row">
                                        <div class="col-md-12">
                                        @error('title')
                                                <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" name="title" placeholder="*العنوان (مطلوب)" maxlength="100" required>
                                            </div>
                                            @error('description')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <textarea name="description" placeholder="الوصف (مطلوب*)" maxlength="200" required></textarea>
                                            </div>
                                        </div>
                                         
                                    </div>
                                    
                                    <h6>الأسعار</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                        @error('price')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                            <div class="input-item  input-item-textarea ltn__custom-icon">
                                                <input type="text" name="price" maxlength="50" placeholder="السعر(فقط رقم)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item ">
                                            <select class="nice-select"  name="currency_id">
                                                    <option value="1">دينار</option>
                                                    <option value="2"> دولار</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" name="price_description" maxlength="100" placeholder="الوصف بعد السعر (مثل: /في الشهر /في الساعة /الاجمالي)">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" name="tax" maxlength="100" placeholder="الضريبة">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <h6>اختر التصنيف والنوع</h6>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="input-item">
                                                <select class="nice-select" name="type_id">
                                                    <option value="">النوع</option>
                                                    @foreach($types as $ty)
                                                    <option value="{{$ty->id}}">{{$ty->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="input-item">
                                                <select class="nice-select" name="category_id" required>
                                                    <option value="">التصنيف</option>
                                                    <option value="2">للتأجير</option>
                                                    <option value="1">للبيع</option>
                                                </select>
                                            </div>
                                        </div>
                                       <!--  <div class="col-lg-4 col-md-6">
                                            <div class="input-item">
                                                <select class="nice-select">
                                                    <option>no status</option>
                                                    <option>Active</option>
                                                    <option>hot offer</option>
                                                    <option>عرض</option>
                                                    <option>open house</option>
                                                    <option>sold</option>
                                                </select>
                                            </div>
                                        </div> -->
                                    </div>
                                    
                                 
                            </div>
                            <div class="" id="liton2">
                                 
                                <hr>
                                    <h6>الصورة الرئيسية للعقار</h6>
                                    
                                    @error('main_image')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                    <input type="file" id="myFile" name="main_image" accept="image/*"  onchange="readURL(this);" class="btn theme-btn-3 mb-10"><br>
                                    <img id="blah" src="#" style="display:none" />
                                    <p> <small>* على الأقل 1 صورة مطلوب لاضافة العقار بنجاح.اقل مقاس 500/500px.</small><br>
                                        <small>* jpg نوع الملفات المدعوم.</small><br>
                                        <small>* من الممكن ان يستغرق معالجة الصور وقت اطول قليلا من المتوقع.</small>
                                    </p>
                                    <div class="col-sm-6 col-lg-6">
                                             <label for="example-text-input" class="col-sm-1 col-form-label text-end"></label>
                                             <h6>صور اضافية</h6>
                                             <div id="myRepeatingFields">
                                                    <div class="entry input-group col-xs-3">
                                                        <table class="table meeting-table class-table">
                                                            <tr>
                                                                    <td><input type="file" name="album[]" accept="image/*" class="btn theme-btn-3 mb-10"/></td> 
                                                                    <td><input type="text" name="a[]" class="d-none"/></td> 

                                                                    <td>  <button type="button" class="btn btn-lg btn-add">
                                                                <span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>
                                                            </button></td>
                                                            </tr>
                                                        </table>
                                                        <span class="input-group-btn">
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                        </div>
                                    <h6>فيديو العقار</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item">
                                                <select class="nice-select">
                                                    <option>المصدر</option>
                                                    <option>vimeo</option>
                                                    <option>youtube</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="200" name="video_link" placeholder="رابط الفيديو">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <h6>الجولة الافتراضية</h6>
                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                        <textarea name="ltn__message" placeholder="Virtual Tour:"></textarea>
                                    </div> -->
                                    <!-- <div class="btn-wrapper text-center--- mt-0">
                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase" >Next Step</button>
                                        <a href="add-listing.html#" class="btn theme-btn-1 btn-effect-1 text-uppercase" >السابق</a>
                                        <a href="add-listing.html#" class="btn theme-btn-1 btn-effect-1 text-uppercase" >التالي</a>
                                    </div> -->
                                
                            </div>
                            <div class="" id="liton3">
                                
                                <hr>
                                    <h6>موقع العقار</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="100" name="address" placeholder="*العنوان" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item">
                                            @error('country_id')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                            <select class="nice-select" id="country_id" name="country_id" required>
                                                    <option>الدولة</option>
                                                    @foreach($countries as $co)
                                                    <option value="{{$co->id}}">{{$co->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                            @error('city_id')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                            <select name="city_id" id="city_id" class="nice-select aac" required>
                                            <option value="">المدينة</option>
                                             </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="100" name="street" placeholder="المنطقة">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="property-details-google-map mb-60">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9334.271551495209!2d-73.97198251485975!3d40.668170674982946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25b0456b5a2e7:0x68bdf865dda0b669!2sBrooklyn%20Botanic%20Garden%20Shop!5e0!3m2!1sen!2sbd!4v1590597267201!5m2!1sen!2sbd" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="100" name="lot" placeholder="Latitude (لخرائط جوجل)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="100" name="lag" placeholder="Longitude (لخرائط جوجل)">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label class="checkbox-item">Enable Google Street View
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->
                                       <!--  <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" name="ltn__name" placeholder="Google Street View - Camera Angle (value from 0 to 360)">
                                            </div>
                                        </div> -->
                                    </div>
                                    <!-- <div class="btn-wrapper text-center--- mt-0">
                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase" >Next Step</button>
                                        <a href="add-listing.html#" class="btn theme-btn-1 btn-effect-1 text-uppercase" >السابق</a>
                                        <a href="add-listing.html#" class="btn theme-btn-1 btn-effect-1 text-uppercase" >التالي</a>
                                    </div> -->
                                
                            </div>
                            <div class="" id="liton4">
                                 
                                <hr>
                                    <h6>تفاصيل العقار</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                        @error('space')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="100" name="space" placeholder="المساحة بالمتر(*only numbers)">
                                            </div>
                                        </div>
                                         
                                        <div class="col-md-6">
                                        @error('number_rooms')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                 <select class="nice-select" name="number_rooms">
                                                    <option  value ="0">عدد الغرف</option>
                                                     <option value ="1">1</option>
                                                    <option value ="2">2</option>
                                                    <option value ="3">3</option>
                                                    <option value ="4">4</option>
                                                    <option value ="5">5</option>
                                                    <option value ="6">6</option>
                                                    <option value ="7">7</option>
                                                    <option value ="8">8</option>
                                                    <option value ="9">9</option>
                                                    <option value ="10">10</option>
                                                    <option value ="11">11</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" name="number_bedrooms" placeholder="غرف النوم (*only numbers)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" name="number_toilets" maxlength="100" placeholder="دورات المياه (*only numbers)">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" name="garage_space" maxlength="100" placeholder="مساحة الكراج">
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                        <div class="input-item">
                                                <select class="nice-select" name="built_year">
                                                    <option  value="">سنة الإنشاء</option>
                                                    <option value="1980">1980</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1999">1999</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                 </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-date">   
                                                <input type="date" name="available_from" > 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="100" name="basement_space" placeholder="مساحة القبو (*text)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="100" name="extra_details" placeholder="تفاصيل اخرى (*text)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <input type="text" maxlength="100" name="roof_space" placeholder="مساحة السطح (*text)">
                                            </div>
                                        </div>
                                         
                                        <div class="col-md-6">
                                            <div class="input-item">
                                                <select class="nice-select" name="floor_no">
                                                    <option  value =" ">طابق رقم</option>
                                                    <option value ="0">Not Available</option>
                                                    <option value ="1">1</option>
                                                    <option value ="2">2</option>
                                                    <option value ="3">3</option>
                                                    <option value ="4">4</option>
                                                    <option value ="5">5</option>
                                                    <option value ="6">6</option>
                                                    <option value ="7">7</option>
                                                    <option value ="8">8</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item">
                                                <select class="nice-select" name="number_floors">
                                                    <option  value =" ">عدد الطوابق</option>
                                                     <option value ="1">1</option>
                                                    <option value ="2">2</option>
                                                    <option value ="3">3</option>
                                                    <option value ="4">4</option>
                                                    <option value ="5">5</option>
                                                    <option value ="6">6</option>
                                                    <option value ="7">7</option>
                                                    <option value ="8">8</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <textarea name="owner_note" maxlength="100" placeholder="ملاحظات الوكيل / المالك (*not visible on front end)"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                     
                                    <!-- <div class="btn-wrapper text-center--- mt-0">
                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase" >Next Step</button>
                                        <a href="add-listing.html#" class="btn theme-btn-1 btn-effect-1 text-uppercase" >Prev Step</a>
                                        <a href="add-listing.html#" class="btn theme-btn-1 btn-effect-1 text-uppercase" >Next Step</a>
                                    </div> -->
                                 
                            </div>
                            <div class="" id="liton5">
                                 
                                <hr>
                                    <h6>وسائل الراحة و الميزات</h6>  
                                     <div class="row">                                
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">ماء
                                                <input type="checkbox" name="amenities[]" value="ماء">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">كهرباء
                                                <input type="checkbox" name="amenities[]" value="كهرباء">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">صالة رياضة
                                                <input type="checkbox" name="amenities[]" value="صالة رياضة">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">مصلى
                                                <input type="checkbox" name="amenities[]" value="مصلى">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                                                     
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">خدمات صيانة
                                                <input type="checkbox" name="amenities[]" value="خدمات صيانة">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">تلفون
                                                <input type="checkbox" name="amenities[]" value="تلفون">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">مصعد
                                                <input type="checkbox" name="amenities[]" value="مصعد">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">انترنت
                                                <input type="checkbox" name="amenities[]" value="انترنت">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">حماية نوافذ
                                                <input type="checkbox" name="amenities[]" value="حماية نوافذ">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">موقف سيارات
                                                <input type="checkbox" name="amenities[]" value="موقف سيارات">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                                                   
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">مكيف
                                                <input type="checkbox" name="amenities[]" value="مكيف">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">تدفئة
                                                <input type="checkbox" name="amenities[]" value="تدفئة">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">طاقة شمسية
                                                <input type="checkbox" name="amenities[]" value="طاقة شمسية">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">مسموح للكلاب
                                                <input type="checkbox" name="amenities[]" value="مسموح للكلاب">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label class="checkbox-item">مسموح للقطط
                                                <input type="checkbox" name="amenities[]" value="مسموح للقطط">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="btn-wrapper text-center--- mt-30">
                                        <!-- <a href="add-listing.html#" class="btn theme-btn-1 btn-effect-1 text-uppercase" >Prev Step</a> -->
                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">إرسال</button>
                                    </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- APPOINTMENT AREA END -->
 

@stop

@section('script')
<!-- <script src="{{asset('SitePage/js/plugins.js ')}}"></script> -->

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

    
 
 
 
 $(function () {
       $(document)
           .on("click", ".btn-add", function (e) {
               e.preventDefault();
               var controlForm = $("#myRepeatingFields:first"),
                   currentEntry = $(this).parents(".entry:first"),
                   newEntry = $(currentEntry.clone()).appendTo(controlForm);
               newEntry.find("input").val("");
               controlForm.find(".entry:not(:last) .btn-add").removeClass("btn-add").addClass("btn-remove").removeClass("btn-success").addClass("btn-danger").html("-");
           })
           .on("click", ".btn-remove", function (e) {
               e.preventDefault();
               $(this).parents(".entry:first").remove();
               return false;
           });
   });

   function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').show()
                        .attr('src', e.target.result)
                        .width(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

@stop

        