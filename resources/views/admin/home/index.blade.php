@extends('layouts.admin.main')
@section('content') 
 
<div class="row g-1 g-sm-3 mb-3 row-deck">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">المستخدمين</span>
                                                        <div><span class="fs-6 fw-bold me-2">{{$users}}</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">اجمالي الطلبات الجديدة</span>
                                                        <div><span class="fs-6 fw-bold me-2">{{$orders}}</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">اجمالي الطلبات التي تم شحنها</span>
                                                        <div><span class="fs-6 fw-bold me-2">{{$orderssh}}</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-fast-delivery fs-3 color-santa-fe"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted"> طلبات اليوم</span>
                                                        <div><span class="fs-6 fw-bold me-2">{{$orderstoday}}</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-files-stack fs-3 color-danger"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">اجمالي المنتجات</span>
                                                        <div><span class="fs-6 fw-bold me-2">{{$prducts}}</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">عدد المنتجات المنتهية</span>
                                                        <div><span class="fs-6 fw-bold me-2">{{$prductsem}}</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-box fs-3 color-light-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> <!-- row end -->
@endsection

@push('js')
    <script src="{{ url('/') }}/cp/assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('/') }}/cp/assets/pages/analytics-index.init.js"></script>
    @endpush