@extends('layouts.admin.main')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Join Requests</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Join requests</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <div class="row">
                    <div class="col-3">
@include('layouts.success')</div>
                @include('layouts.error')
</div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="datatable_pro">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>type</th>
                                            <th>category</th>
                                            <th>price</th>
                                            <th>created at</th>
                                            <th>space</th>
                                            <th>image</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

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

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src=" /cp/assets/plugins/datatables/datatables.min.js"></script>
    <script src=" /cp/assets/plugins/datatables/datatables_advanced.js"></script>

    <script>
       $(document).ready(function(){


            var pTable = $('#datatable_pro').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                ajax: {
                    url: '{{route('admin.propertiesajax')}}',
                    type: 'get',
                    data: function(d){
                        d._token = "{{csrf_token()}}"

                    }
                },

                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'type' },
                    { data: 'category' },
                    { data: 'price' },
                    { data: 'created_at' },
                    { data: 'space' },
                    { data: 'image' },
                    { data: 'actions' },
                ],
                "columnDefs": [
                    { "orderable": false, "targets": 6,
                         "width": "8%", "targets": 6,
                        "width": "5%", "targets": 0
                    }
                ]


            });


        });
    </script>
    
@endpush