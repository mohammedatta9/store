  <!-- sidebar -->
  <div class="sidebar px-4 py-4 py-md-4 me-0">
            <div class="d-flex flex-column h-100">
                <a href="index.html" class="mb-0 brand-icon">
                   
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    
                    <span> 
                        <img src="{{ url('/') }}/SitePage\img\shDwhyOpRcJqOik0mt1qSP4uC37qSXqbmlMrHAVR.png" alt="logo-small"  >
                    </span>                </a>
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3">
                    <li><a class="m-link " href="{{ route('admin.home') }}"><i class="icofont-home fs-5"></i> <span>الرئيسية</span></a></li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">
                            <i class="icofont-truck-loaded fs-5"></i> <span>المنتجات</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <!-- Menu: Sub menu ul -->
                            <ul class="sub-menu collapse" id="menu-product">
                            <li><a class="ms-link" href="{{route('admin.products')}}">عرض المنتجات</a></li>
                            <li><a class="ms-link" href="{{ route('admin.add.product') }}">اضف منتج</a></li>
                                 
                            </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#categories" href="#">
                            <i class="icofont-chart-flow fs-5"></i> <span>الاقسام</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <!-- Menu: Sub menu ul -->
                            <ul class="sub-menu collapse" id="categories">
                                <li><a class="ms-link" href="{{route('admin.categories')}}">عرض الاقسام</a></li>
                           
                            </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-order" href="#">
                        <i class="icofont-notepad fs-5"></i> <span>الطلبات</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-order">
                            <li><a class="ms-link" href="{{route('admin.orders')}}">الطلبات الجديدة</a></li>
                           
                        </ul>
                        <ul class="sub-menu collapse" id="menu-order">
                            <li><a class="ms-link" href="{{route('sh.admin.orders')}}">طلبات تم شحنها</a></li>
                           
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#customers-info" href="#">
                        <i class="icofont-funky-man fs-5"></i> <span>المستخدمين</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="customers-info">
                            <li><a class="ms-link" href="{{ route('admin.user')  }}">عرض المستخدمين</a></li>
                         </ul>
                    </li> 
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#app" href="#">
                        <i class="icofont-space fs-5"></i> <span>الدول\المدن</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="app">
                            <li><a class="ms-link" href="{{route('admin.countries')}}">عرض الدول\المدن</a></li>
                         </ul>
                    </li>
                    @if(Auth::user()->id == 1)
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#customers-info2" href="#">
                        <i class="icofont-funky-man fs-5"></i> <span>المشرفين</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="customers-info2">
                            <li><a class="ms-link" href="{{ route('admin.admin')  }}">عرض المشرفين</a></li>
                         </ul>
                         <ul class="sub-menu collapse" id="customers-info2">
                            <li><a class="ms-link" href="{{ route('admin.admin.add')  }}">اضف مشرف</a></li>
                         </ul>
                         <ul class="sub-menu collapse" id="customers-info2">
                            <li><a class="ms-link" href="/admin/admin/profile/1">المشرف الرئيسي</a></li>
                         </ul>
                    </li> 
                    @endif
                    <li><a class="m-link" href="{{route('admin.discounts')}}"><i class="icofont-code fs-5"></i> <span> اكواد الخصم  </span></a></li>
                    <li><a class="m-link" href="{{route('admin.carousels')}}"><i class="icofont-file-bmp fs-5"></i> <span> سلايدر الصفحة الرئيسية</span></a></li>

                    <li><a class="m-link" href="{{route('settings.index')}}"><i class="icofont-gear fs-5"></i> <span> الاعدادات  </span></a></li>
                     
                </ul>
                <!-- Menu: menu collepce btn -->
                <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                    <span class="ms-2"><i class="icofont-bubble-right"></i></span>
                </button>
            </div>
        </div>