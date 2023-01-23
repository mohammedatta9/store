@extends('layouts.layoutSite.SitePage')
@section('title','تواصل معنا')
@section('content')


    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="{{asset('SitePage/img/bg/14.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">تواصل معنا</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{route('viewHomePage')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> الصفحة الرئيسية</a></li>
                                <li>تواصل معنا</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- CONTACT ADDRESS AREA START -->
    <div class="ltn__contact-address-area mb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ url('/') }}/sitePage/img/icons/10.png" alt="Icon Image">
                        </div>
                        <h3>عنوان البريد الإلكتروني</h3>
                        <p>{{$email}} </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ url('/') }}/sitePage/img/icons/11.png" alt="Icon Image">
                        </div>
                        <h3>رقم الهاتف</h3>
                        <p>{{$phone}} </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ url('/') }}/sitePage/img/icons/12.png" alt="Icon Image">
                        </div>
                        <h3>عنوان المكتب</h3>
                        <p>{{$address}}  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT ADDRESS AREA END -->

    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area mb-120 mb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                        <h4 class="title-2">ادخل رسالة</h4>
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{session::get('success')}}
                            </div>
                        @endif
                        <form id="contact-form" action="{{route('storeMessage')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                @error('name')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" maxlength="100" placeholder="ادخل الاسم الخاص بك" value="{{old('name')}}">
                                    </div>
                                   
                                </div>
                                <div class="col-md-6">
                                @error('email')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                    <div class="input-item input-item-email ltn__custom-icon">
                                        <input type="email" name="email" maxlength="100" placeholder="ادخل البريد الالكتروني" value="{{old('email')}}">
                                    </div>
                                   
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item">
                                    @error('type_id')
                                        <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                        <select class="nice-select" name="type_id">
                                            <option >حدد نوع الخدمة</option>
                                            <option value="1">إدارة العقارات </option>
                                            <option value="2"> الرهن العقاري </option>
                                            <option value="3">خدمة استشارية</option>
                                            <option value="4">شراء المنازل</option>
                                            <option value="5">بيع المنازل</option>
                                            <option value="6">خدمات الضمان</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                @error('phone')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                    <div class="input-item input-item-phone ltn__custom-icon">
                                        <input type="text" name="phone" maxlength="80" placeholder="ادخل رقم الهاتف"  value="{{old('phone')}}">
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="input-item input-item-textarea ltn__custom-icon">
                            @error('message')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                                <textarea name="message" maxlength="300" placeholder="ادخل نص الرسالة">{{old('message')}}</textarea>
                               
                            </div>
                             <div class="btn-wrapper mt-0">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">حفظ الرسالة </button>
                            </div>
                            <p class="form-messege mb-0 mt-20"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <!-- CONTACT MESSAGE AREA END -->

    <!-- GOOGLE MAP AREA START -->
    <div class="google-map mb-120">

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9334.271551495209!2d-73.97198251485975!3d40.668170674982946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25b0456b5a2e7:0x68bdf865dda0b669!2sBrooklyn%20Botanic%20Garden%20Shop!5e0!3m2!1sen!2sbd!4v1590597267201!5m2!1sen!2sbd" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    </div>
    <!-- GOOGLE MAP AREA END -->

@stop

@section('script')   

<script src="{{asset('SitePage/js/plugins.js ')}}"></script>
<script src="{{asset('SitePage/js/main.js')}}"></script>

@stop

