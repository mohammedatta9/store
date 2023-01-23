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
                             
                            <h4 class="page-title">المستخدمين</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>

                <div class="row">
                    
                    <div class="table-responsive">
                    <table id="aaaa" class="table table-hover align-middle mb-0" style="width:90%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>الايميل</th>
                                        <th>العمليات</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $user)
                                    @if($user->id != 1)
                                    <tr class="R_user{{$user->id}}">
                                        <td>{{$loop->iteration}} </td>
                                        <td>{{$user->fname}} {{$user->lname}} </td>
                                        <td>{{$user->email}} </td>
                                         <td>  <a href="{{ route('admin.admin.profile', $user->id)}}"><i class="icofont-edit  text-secondary font-20"></i></a>
                                        <a  href=" " class="deletem_b"  deletem_b="{{$user->id}}"> <i class="icofont-trash text-danger font-20"></i></a>
                                        </td>
                                        </tr>
                                        @endif
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
@push('js')
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

<script src="{{ url('/') }}/cp/assets/bundles/dataTables.bundle.js"></script>  

<script>
    
    $('#aaaa')
    .addClass( 'nowrap' )
    .dataTable( {
        responsive: true,
        columnDefs: [
            { targets: [-1, -3], className: 'dt-body-right' }
        ]
    });

$(document).on("click", ".deletem_b", function (e) {
        e.preventDefault();
        if(confirm( `  Are you sure? ` )){
        var deletem_b = $(this).attr("deletem_b");
        $.ajax({
            type: "post",
            url: "{{route('admin.admin.delete')}}",
            data: {
                _token: "{{csrf_token()}}",
                id: deletem_b,
            },
            success: function (data) {
                if (data.status == true) {
                  
                 
                }
                flashBox('success', ' تم الحذف');

                $(".R_user" + data.id).remove();
            },
            error: function (reject) {},
        });
    }
    });
    </script>
    @endpush