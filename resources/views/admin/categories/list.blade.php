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
                             
                            <h4 class="page-title">الاقسام</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
               @include('layouts.success')
                @include('layouts.error')
                

                <div class="row">
                    <div class="col-12">
                        <div class="card">


                            <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#Post" role="tab"
                                           aria-selected="true">الاقسام</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Settings" role="tab"
                                           aria-selected="false"> اضف قسم</a>
                                    </li>
                                </ul>

                            <div class="tab-content">
                              <div class="tab-pane p-3 active" id="Post" role="tabpanel">
                                <div class="table-responsive">
                                 <table id="example" class="table table-striped table-bordered" style="width:70%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>القسم</th>
                                        <th>القسم الرئيسي</th>
                                        <th>العمليات</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $c)
                                    <tr class="R_category{{$c->id}}">
                                        <td>{{$loop->iteration}} </td>
                                        <td>{{$c->name}} </td>
                                        <td>@if($c->category){{$c->category->name}}@else رئيسي@endif </td>
                                        <td>  <a href="{{ route('admin.category.profile', $c->id)}}"><i class="icofont-edit  text-secondary font-40"></i></a>
                                        <a href=" " class="deletem_b" deletem_b="{{$c->id}}"><i class="icofont-trash  text-danger  "></i></a>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                 </table>
                                 </div>
                                 </div>
                                 <div class="tab-pane p-3" id="Settings" role="tabpanel">
                                        <div class="row">
                                        <div class="card">
                                        <form name="" method="post" action="{{ route('admin.category.save') }}"   enctype= "multipart/form-data" >
                                     @csrf
 
                                        <div class="row">
                                        <div class="mb-4 row">
                                            <label for="example-text-input" class="col-sm-1 col-form-label text-end">الاسم</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" name="name" type="text" maxlength="50" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-4 row">
                                            <label for="example-text-input" class="col-sm-1 col-form-label text-end">يتبع لقسم</label>
                                            <div class="col-sm-6">
                                                <select class="form-control"  name="category_id">
                                                    
                                                     <option value="">   اختر قسم  </option>
                                                     @foreach($categories as $ca)
                                                     <option value="{{$ca->id}}"> {{$ca->name}}</option>
                                                     @endforeach
                                                 </select>        
                                           </div>
                                        </div>  
                                        </div><!--end row-->
                                        <div class="form-group mb-3 row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-primary">
                                                حفظ
                                            </button>
                                             
                                        </div>
                                        </div>
                                    </form>
                                                </div>

                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div><!-- container -->


        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->


@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
 
<script>
$('.deletem_b').on("click", function (e) {
            e.preventDefault();
               
         var id = $(this).attr('deletem_b');
         
         
         $.ajax({
                type: "post",
                url: "{{ route('delete_category') }}",
                data: { _token: '{{ csrf_token() }}',
                     "id" : id },
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                        $(".R_category"+ data.id).remove();
                       
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
@endpush