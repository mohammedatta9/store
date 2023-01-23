@extends('layouts.layoutSite.SitePage')
@section('title','تسجيل الدخول')
@section('content')

 

<!-- start breadcrumb -->

<section class="section-breadcrumb p-2">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                  <li class="breadcrumb-item active" aria-current="page">إنشاء حساب</li>
                </ol>
              </nav>
        </div>
    </div>
</section>
<!-- end breadcrumb -->


<section class="container section-creat-account">
    <div class="row">
        <p class="h4">إنشاء حساب</p>
        <div class="col-md-4 m-auto my-5">
        <form method="POST" action="{{ route('register') }}" class="ltn__form-box contact-form-box">
                            @csrf

            <div class="mb-3">
                <label for="user-name-or-email" class="form-label">   البريد الالكتروني</label>
                @error('email')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                            @if (\Session::has('error'))
                            <small class="form-text text-danger">
                                {{ \Session::get('error')}}
                            </small>
                            @endif
                <input type="text" name="email" class="form-control" id="user-name-or-email"  value="{{old('email')}}" >
              </div>
        
        <div class="mb-3">
            <label for="user-mobile" class="form-label">رقم الموبايل</label>
            @error('phine')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            <input type="text" name="phone"  class="form-control" id="user-mobile"  value="{{old('phone')}}">
          </div>
          <div class="mb-3">
            <label for="user-password" class="form-label">كلمة المرور</label>
            <div class="input-group">
            @error('password')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                <button type="button" class="btn btn-eye bi bi-eye"></button>
                <input type="password" class="form-control" name="password" aria-label="user-password" aria-describedby="user-password">
            </div><br>
            <div class="mb-3">
            <label for="user-password" class="form-label">تاكيد كلمة المرور</label>
            <div class="input-group">
            @error('password_confirmation')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                <button type="button" class="btn btn-eye bi bi-eye"></button>
                <input type="password" class="form-control" name="password_confirmation" aria-label="user-password" aria-describedby="user-password">
            </div></div>
</form>
            <input type="submit" class="btn btn-warning w-100 btn-create-acount my-4 text-light" value="إشاء حساب">
<div class="or"><span>أو</span></div>
            <div class="text-center">
            <a href="{{route('login')}}" class="my-4 d-block">العودة لصفحة تسجيل الدخول</a>
            <p>من خلال التسجيل لإنشاء حساب أنا أقبل
                الشروط والأحكام</p>
                </div>
            
          </div>
        </div>
    </div>
</section>

@stop

 

