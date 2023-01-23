@extends('layouts.layoutSite.SitePage')
@section('content')
 
<section class="section-breadcrumb p-2">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">الرئيسية</a></li>
                  <li class="breadcrumb-item active" aria-current="page">الشروط والاحكام</li>
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
             {!!$data!!}
</div>
</div>
</div>
</section>

@stop

@section('script')

<script src="{{asset('SitePage/js/plugins.js ')}}"></script>
<script src="{{asset('SitePage/js/main.js')}}"></script>

@stop

