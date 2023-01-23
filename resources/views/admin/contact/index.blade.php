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
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Mentors</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Mentors</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>

                <div class="row">
                    
                    <div class="table-responsive">
                                 <table id="example" class="table table-striped table-bordered" style="width:90%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>phone</th>
                                        <th>Message</th>
                                        <th>Actions</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contact as $c)
                                    <tr class="R_user{{$c->id}}">
                                        <td>{{$loop->iteration}} </td>
                                        <td>{{$c->name}}</td>
                                        <td>{{$c->email}} </td>
                                        <td>@if($c->type){{$c->type->name}}@endif </td>
                                        <td>{{$c->phone}} </td>
                                        <td>{{$c->message}} </td>
                                        <td>
                                         <a  href=" " class="deletem_b" onclick=" return confirm( `  Are you sure? ` )" deletem_b="{{$c->id}}"><i class=" las la-trash text-danger font-20"></i></a>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                 </table>
                                 </div>
                </div><!--end row-->

            </div><!-- container -->



        </div>
        <!-- end page content -->
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

<script>

$(document).on("click", ".deletem_b", function (e) {
        e.preventDefault();
        var deletem_b = $(this).attr("deletem_b");
        $.ajax({
            type: "post",
            url: "{{route('admin.contact.delete')}}",
            data: {
                _token: "{{csrf_token()}}",
                id: deletem_b,
            },
            success: function (data) {
                if (data.status == true) {
                  
                 
                }

                $(".R_user" + data.id).remove();
            },
            error: function (reject) {},
        });
    });
    </script>