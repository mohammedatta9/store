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
                  <li class="breadcrumb-item active" aria-current="page"> تسجيل الدخول</li>
                </ol>
              </nav>
        </div>
    </div>
</section>
<!-- end breadcrumb -->


<section class="container section-creat-account">
    <div class="row">
        <p class="h4"> تسجيل الدخول</p>
        <div class="col-md-4 m-auto my-5">
        <form method="POST" action="{{route('login')}}" class="ltn__form-box contact-form-box">
                            @csrf

            <div class="mb-3">
                <label for="user-name-or-email" class="form-label"> البريد الالكتروني</label>
                
                @error('email')
                            <small class="form-text text-danger">كلمة المرور او الايميل لا تتطابق مع سجلاتنا. </small>
                            @enderror
                <input type="text" name="email" value="{{old('email')}}" class="form-control" id="user-name-or-email" >
              </div>
         
          <div class="mb-3">
            <label for="user-password" class="form-label">كلمة المرور</label>
            <div class="input-group">
                <button type="button" class="btn btn-eye bi bi-eye"></button>
                @error('password')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                <input type="password" name="password" class="form-control" aria-label="user-password" aria-describedby="user-password">
            </div>
            <input type="submit" class="btn btn-warning w-100 btn-create-acount my-4 text-light" value="   تسجيل الدخول">
<div class="or"><span>أو</span></div>
            <div class="text-center">
            <a href="{{route('register')}}" class="my-4 d-block"> الاشتراك </a>
             
                </div>
            
          </div>
</form>
        </div>
    </div>
</section>

@stop

 

