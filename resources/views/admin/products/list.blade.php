@extends('layouts.admin.main')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

@section('content')


    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content-tab">

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-8">
                        <div class="page-title-box">
                         
                            <h4 class="page-title">المنتجات</h4> 
                        </div> 
                    </div>
                    <div class="col-sm-4"> 
                        <a href="/qtyproduct"  class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">تحديث كميات المنتجات</a>
 
                    </div>
                    <!--end col-->
                </div><br>
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
                                    <table class="table" id="datatable_pro1">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Id</th>
                                            <th>اسم المنتج</th>
                                            <th>السعر</th>
                                            <th>تاريخ الاضافة</th>
                                            <th>الصورة</th>
                                            <th>الكود</th>
                                            <th>الكمية</th>
                                            <th>العمليات</th>
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


            var pTable = $('#datatable_pro1').DataTable({
                processing: true,
                searching: true,
                serverSide: true,
                ajax: {
                    url: '{{route('admin.productsajax')}}',
                    type: 'get',
                    data: function(d){
                        d._token = "{{csrf_token()}}"

                    }
                },

                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'price' },
                    { data: 'created_at' },
                    { data: 'image' },
                    { data: 'code' },
                    { data: 'quantity' },
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