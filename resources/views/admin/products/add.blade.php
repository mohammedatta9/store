@extends('layouts.admin.main')
@section('content')
    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content-tab">

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            
                            <h4 class="page-title">اضافة منتج</h4>
                             
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                    @include('layouts.success')
                    @include('layouts.error')
                </div>
                
                <form name="" method="post" action="{{ route('admin.product.save') }}"   enctype= "multipart/form-data" >
                                     @csrf
                <!-- end page title end breadcrumb -->
                <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">   اضافة منتج</h3>
                                <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">حفظ</button>
                            </div>
                        </div>
                   </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                             
                            <div class="card-body p-0">
                               

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane p-3 active" id="Post" role="tabpanel">

 
                                        <div class="row">
                                        
                                        <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label  class="col-sm-3 "></label>
                                            <div class="col-sm-9">
                                            <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" value="1" name="featured" type="checkbox"   >
                                            <label class="form-check-label" for="customSwitchSuccess">منتج رائج</label>
                                        </div>
                                     </div>
                                        </div><br>
                                        <div class="mb-3 row">
                                       
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">اسم المنتج</label>
                                            <div class="col-sm-9">
                                            @error('name')
                                            <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                                <input class="form-control" name="name" type="text" value="{{old('name')}}" id="example-text-input"  maxlength="100">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                        
                                            <label   class="col-sm-3 col-form-label text-end">وصف المنتج</label>
                                            <div class="col-sm-9">
                                            @error('description')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                            <textarea class="form-control" name="description" rows="5" maxlength="300" >{{old('description')}}</textarea>                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                        
                                            <label   class="col-sm-3 col-form-label text-end">السعر بالدينار الكويتي</label>
                                            <div class="col-sm-9">
                                            @error('price')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                                <input class="form-control" name="price" type="number"  maxlength="100" value="{{old('price')}}"   >
                                            </div>
                                        </div>
                                         
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">السعر البديل</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="price_alternative"  maxlength="100" value="{{old('price_alternative')}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <!-- <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">tax</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="tax" type="text"  maxlength="100" value="{{old('tax')}}" >
                                            </div>
                                        </div>     -->
                                        @error('code')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">رمز السلعة</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="code" name="code" type="text"  maxlength="100" value="{{old('code')}}" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">القسم</label>
                                            <div class="col-sm-9">
                                            @error('category_id')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                            <div class="card-body" style="  height: 160px;  overflow: auto;">
                                            @foreach($category as $ca)

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{$ca->id}}" name="category_id[]"id="sizechek{{$ca->id}}">
                                                    <label class="form-check-label" for="sizechek1">
                                                    {{$ca->name}}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                             
                                           </div>
                                        </div>   
                                        
                                        <div class="mb-3 row">
                                       
                                            <label   class="col-sm-3 col-form-label text-end">كمية المنتج</label>
                                            <div class="col-sm-9">
                                            @error('quantity')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                                <input class="form-control" id="qty" name="quantity" type="number"  maxlength="100" value="{{old('quantity')}}" >
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">الحجم</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="size" type="text"  maxlength="100" value="{{old('size')}}" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">  الضمان </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="guarantee" type="text"  maxlength="100" value="{{old('guarantee')}}" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">SKU</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="sku" type="text"  maxlength="100" value="{{old('sku')}}" >
                                            </div>
                                        </div>     
                                    </div>
                                    
                                    <div class="col-lg-6">
                                         
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end"></label>
                                           
                                        </div>
                                        <div class="mb-3 row">
                                       
                                            <label   class="col-sm-3 col-form-label text-end">الصورة الرئيسية</label>
                                            <div class="col-sm-9">
                                            @error('main_image')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                            <input type="file" name="main_image" class="form-control" value="{{old('main_image')}}" />   
                                             </div>
                                        </div> 
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">صور اضافية</label>
                                            <div id="myRepeatingFields" class="col-sm-9"> 
                                                    <div class="entry input-group col-xs-3">
                                                        <table class="table meeting-table class-table">
                                                            <tr>
                                                                    <td><input type="file" name="album[]" accept="image/*" class="btn theme-btn-3 mb-10 form-control"/></td> 
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
                                            <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end"> الالوان</label>
                                            <div id="myRepeatingFields_co" class="col-sm-9"> 
                                                    <div class="entry_co input-group col-xs-3">
                                                        <table class="table meeting-table class-table">
                                                            <tr>
                                                                    <td><input type="color" name="color[]" /></td> 
                                                                    <td><input type="text" name="co[]" class="d-none"/></td> 

                                                                    <td>  <button type="button" class="btn btn-lg btn-add-co">
                                                                <span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>
                                                            </button></td>
                                                            </tr>
                                                        </table>
                                                        <span class="input-group-btn">
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                               
                                            </div> 
                                            <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">   ملحقات</label>
                                            <div id="myRepeatingFields_op" class="col-sm-9"> 
                                                    <div class="entry_op input-group col-xs-3">
                                                        <table class="table meeting-table class-table">
                                                            <tr>
                                                                    <td><input type="text" name="option[]"  placeholder="الملحق" class="btn theme-btn-2 form-control"/></td> 
                                                                    <td><input type="number" name="price_op[]" placeholder=" السعر"  class="btn theme-btn-2 form-control"/></td> 
                                                                    <td><input type="text" name="op[]" class="d-none"/></td> 
                                                                    <td>  <button type="button" class="btn btn-lg btn-add-op">
                                                                <span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>
                                                            </button></td>
                                                            </tr>
                                                        </table>
                                                        <span class="input-group-btn">
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">الحالة</label>
                                            <div class="col-sm-9">
                                          
                                                <select class="form-control"  name="status">
                                                     
                                                     @if( old('status') )
                                                     <option value="{{old('status')}}" selected>@if(old('status') == 1 ) فعال @else غير فعال @endif</option>@endif
                                                      <option value="1"> فعال</option>
                                                     <option value="2"> غير فعال</option>
                                                     
                                                 </select>        
                                           </div>
                                        </div>   
                                         
                                        
                                                      
                                    </div> 
                                     
                                      
                                   
                                        </div><!--end row-->
                                        
                                    </form>
                                    </div>
                                    <div class="tab-pane p-3" id="Gallery" role="tabpanel">
                                        <div class="row">

                                        </div><!--end row-->

                                    </div>
                                    
                                </div>
                            </div> <!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->

            </div><!-- container -->

            <!--Start Rightbar-->
            <!--Start Rightbar/offcanvas-->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
                    <button type="button" class="btn-close text-reset p-0 m-0 align-self-center"
                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h6>Account Settings</h6>
                    <div class="p-2 text-start mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch1">
                            <label class="form-check-label" for="settings-switch1">Auto updates</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                            <label class="form-check-label" for="settings-switch2">Location Permission</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="settings-switch3">
                            <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                        </div><!--end form-switch-->
                    </div><!--end /div-->
                    <h6>General Settings</h6>
                    <div class="p-2 text-start mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch4">
                            <label class="form-check-label" for="settings-switch4">Show me Online</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                            <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="settings-switch6">
                            <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                        </div><!--end form-switch-->
                    </div><!--end /div-->
                </div><!--end offcanvas-body-->
            </div>
            <!--end Rightbar/offcanvas-->
            <!--end Rightbar-->


        </div>
        <!-- end page content -->
    </div>

@endsection
@push('js')
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
   $(function () {
       $(document)
           .on("click", ".btn-add-co", function (e) {
               e.preventDefault();
               var controlForm = $("#myRepeatingFields_co:first"),
                   currentEntry = $(this).parents(".entry_co:first"),
                   newEntry = $(currentEntry.clone()).appendTo(controlForm);
               newEntry.find("input").val("");
               controlForm.find(".entry_co:not(:last) .btn-add-co").removeClass("btn-add-co").addClass("btn-remove-co").removeClass("btn-success").addClass("btn-danger").html("-");
           })
           .on("click", ".btn-remove-co", function (e) {
               e.preventDefault();
               $(this).parents(".entry_co:first").remove();
               return false;
           });
   });
   $(function () {
       $(document)
           .on("click", ".btn-add-op", function (e) {
               e.preventDefault();
               var controlForm = $("#myRepeatingFields_op:first"),
                   currentEntry = $(this).parents(".entry_op:first"),
                   newEntry = $(currentEntry.clone()).appendTo(controlForm);
               newEntry.find("input").val("");
               controlForm.find(".entry_op:not(:last) .btn-add-op").removeClass("btn-add-op").addClass("btn-remove-op").removeClass("btn-success").addClass("btn-danger").html("-");
           })
           .on("click", ".btn-remove-op", function (e) {
               e.preventDefault();
               $(this).parents(".entry_op:first").remove();
               return false;
           });
   });
   $('.deletem_b').on("click", function (e) {
              //  e.preventDefault();
               
         var id = $(this).attr('deletem_b');
         
         
         $.ajax({
                type: "post",
                url: "{{ route('delete_album') }}",
                data: { _token: '{{ csrf_token() }}',
                     "id" : id },
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                        $(".R_album"+ data.id).remove();
                       
                    },
                    error: function (err) {
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            $('#success_message_notifications').fadeIn().html('<div class="alert alert-danger border-0 alert-dismissible">' + err.responseJSON.message +'</div>');


                        }
                    }
                });   
          
    });

    $(document).ready(function () {
        $('#code').on('change', function () {
            var code = $('#code').val();
            if (code) {
                $.ajax({
                    url: "https://db.alwansolar.com/api/getqty/" + code,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#qty').empty();
                        $('#qty').val(data);
                        flashBox('success', 'تم استدعاء الكمية حسب رمز المنتج');

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endpush