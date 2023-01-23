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
لتتبع طلبك , يرجى إدخال رقم طلبك في المربع ادناه والضغط على الزر "تتبع" , تم اعطاؤك هذا في إيصالك وفي رسالة التاكيد الإلكترونية التى من المفترض أن تكون قد تلقيتها .</p>
<div class="col-md-4 m-auto my-5">
        <form method="POST" action="{{route('numberorder')}}" class="ltn__form-box contact-form-box">
                            @csrf

            <div class="mb-3">
                <label for="user-name-or-email" class="form-label">    رقم الطلب</label>
        
                <input type="text" name="number"   class="form-control" id="user-name-or-email" >
              </div>
          
            <input type="submit" class="btn btn-warning w-100 btn-create-acount my-4 text-light" value="  تتبع الطلب">
 
            
          </div>
</form>
        </div>
 
<br>
 
<hr>
 

    </div>
</section>


@stop

@push('js')   
    
    @endpush

