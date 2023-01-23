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
                            <div class="float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"></a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                            </div>
                            <h4 class="page-title">country detail</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                    @include('layouts.success')
                    @include('layouts.error')
                </div>
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                             
                            <div class="card-body p-0">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#Post" role="tab"
                                           aria-selected="true">Eitd country</a>
                                    </li>
                                    
                                    <li class="nav-item"> 
                                        <a class="nav-link" data-bs-toggle="tab" href="#Settings" role="tab"
                                           aria-selected="false"> country cities</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane p-3 active" id="Post" role="tabpanel">
                                     <form name="" method="post" action="{{ route('admin.country.edit') }}"   enctype= "multipart/form-data" >
                                     @csrf
                                     <input   type="text" name="id" value="{{$country->id}}"  style="display:none;">

                                        <div class="row">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-1 col-form-label text-end">name</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" name="name" type="text" value="{{$country->name}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="col-sm-9 col-lg-9">
                                             <label for="example-text-input" class="col-sm-1 col-form-label text-end">Cities</label>
                                                <div id="myRepeatingFields">
                                                    <div class="entry input-group col-xs-3">
                                                        <table class="table meeting-table class-table">
                                                            <tr>
                                                                    <td><input type="text" name="city[]" class="form-control"/></td> 
                                                                    
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

                                        </div><!--end row-->
                                        <div class="form-group mb-3 row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                             
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="tab-pane p-3" id="Gallery" role="tabpanel">
                                        <div class="row">

                                        </div><!--end row-->

                                    </div>
                                    <div class="tab-pane p-3" id="Settings" role="tabpanel">
                                        <div class="row">
                                        <div class="card">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Action</th>
                                                                
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($country->cities as $c)
                                                                <tr class="R_city{{$c->id}}">
                                                                    <td>{{ $c->id }}</td>
                                                                    <td>{{ $c->name }} </td>
                                                                    <td> <span> <a href="#!" class="deletem_b" deletem_b="{{$c->id}}">Delete</a></span></td>

                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table><!--end /table-->
                                                    </div>
                                                </div>

                                            </div><!--end col-->
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
                            <input class="form-check-input" type="checkbox" id="settings-switch1" >
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

<script> 
 
 
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

</script>
<script>
$('.deletem_b').on("click", function (e) {
              //  e.preventDefault();
               
         var id = $(this).attr('deletem_b');
         
         
         $.ajax({
                type: "post",
                url: "{{ route('delete_city') }}",
                data: { _token: '{{ csrf_token() }}',
                     "id" : id },
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                        $(".R_city"+ data.id).remove();
                        flashBox('success', ' تم الحذف');

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