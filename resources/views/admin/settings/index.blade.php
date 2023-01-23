@extends('layouts.admin.main')
@section('content')
<style>
    .tox-notification { display: none !important }
    </style>
    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content-tab">

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">   اعدادات الموقع</h4>
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
                            <div class="card-body">
                                <div class="met-profile">
                                    <!-- aeaeaevd -->
                                </div><!--end f_profile-->
                            </div><!--end card-body-->
                            <div class="card-body p-0">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#Post" role="tab"
                                           aria-selected="true">الاعدادات الرئيسيه</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Settings" role="tab"
                                           aria-selected="false">تعديل الصفحات </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#posts" role="tab"
                                           aria-selected="false">معلومات الموقع</a>
                                    </li>
                               
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#a" role="tab"
                                           aria-selected="false">تواصل الاجتماعي</a>
                                    </li>
                                     
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#c" role="tab"
                                           aria-selected="false">Seo</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane p-3 active" id="Post" role="tabpanel">
                                     <form enctype="multipart/form-data" method="post" action="{{route('settings.update','test')}}">
                                    @csrf 
                                        <div class="row">
                                        
                                        <div class="col-lg-6">
                                       
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">اسم الموقع</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="site_name" type="text" value="{{$setting['site_name']}}" id="example-text-input">
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end"></label>
                                            <div class="col-sm-9">
                                            @if($setting['header_logo'])
                                            <img src="{{asset('/storage/users/'.$setting['header_logo'])}}" alt="header_logo"  width="100">
                                            @endif
                                            </div>
                                        </div>
                                       
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">تغيير شعار الموقع</label>
                                            <div class="col-sm-9">
                                            <input type="file" name="header_logo" class="form-control"  />   
                                             </div>
                                        </div> 
                                        </div>
 
                                    
                                    </div><!--end row-->
                                        <div class="form-group mb-3 row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-primary">
                                                تحديث
                                            </button>
                                             
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                     
                                    <div class="tab-pane p-3" id="Settings" role="tabpanel">
                                    <form enctype="multipart/form-data" method="post" action="{{route('settings.update','test')}}">
                                    @csrf 
                                        <div class="row">
                                        
                                        <div class="col-lg-12">
                  
                                        <div class="mb-1 row">
                                            <h3>سياسة الخصوصية </h3>
                                            <div class="col-sm-12"> 
                                            <textarea  id="textarea" name="section1_details" rows="10" >{{$setting['section1_details']}}</textarea>                                      
                                           </div>
                                        </div>
                          <hr>
                                        <div class="mb-1 row">
                                            <h3>الشحن والاستلام</h3>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="textarea1" name="section2_details" rows="5" >{{$setting['section2_details']}}</textarea>                                      
                                           </div>
                                        </div>                          <hr>

                                       <div class="mb-1 row">
                                            <h3>الشروط والاحكام  </h3>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="textarea2" name="section3_details" rows="5" >{{$setting['section3_details']}}</textarea>                                      
                                           </div>
                                        </div>                          <hr>

                                        <div class="mb-1 row">
                                            <h3> الاسئلة الشائعة </h3>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="textarea3" name="section4_details" rows="5" >{{$setting['section4_details']}}</textarea>                                      
                                           </div>
                                        </div>                          <hr>

                                        <div class="mb-1 row">
                                            <h3> من نحن </h3>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="textarea4" name="section5_details" rows="5" >{{$setting['section5_details']}}</textarea>                                      
                                           </div>
                                        </div>
                                        </div> 
                                    </div><!--end row-->
                                        <div class="form-group mb-3 row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-primary">
                                            تحديث
                                            </button>
                                             
                                        </div>
                                        </div>
                                    </form>
                                        </div>
                                        <div class="tab-pane p-3" id="posts" role="tabpanel">
                                        <form enctype="multipart/form-data" method="post" action="{{route('settings.update','test')}}">
                                    @csrf 
                                        <div class="row">
                                        
                                        <div class="col-lg-6">
                                       
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">تلفون</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="phone1" type="text" value="{{$setting['phone1']}}" id="example-text-input">
                                            </div>
                                        </div>
                                          
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">العنوان الرئيسي</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="address" type="text" value="{{$setting['address']}}" id="example-text-input">
                                            </div>
                                        </div>
                                         
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="email" type="email" value="{{$setting['email']}}" id="example-text-input">
                                            </div>
                                        </div>

                                         
                                        </div>

                                     
                                    
                                    </div><!--end row-->
                                        <div class="form-group mb-3 row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-primary">
                                            تحديث
                                            </button>
                                             
                                        </div>
                                        </div>
                                    </form>
                                     </div>
                                     <div class="tab-pane p-3" id="a" role="tabpanel">
                                     <form enctype="multipart/form-data" method="post" action="{{route('settings.update','test')}}">
                                    @csrf 
                                        <div class="row">
                                        
                                        <div class="col-lg-6">
                                       
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">رابط الفيس بوك</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="facebook_link" type="text" value="{{$setting['facebook_link']}}" id="example-text-input">
                                            </div>
                                        </div>
                                         
                                       
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end"> رابط الانستغرام   </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="instagram_link" type="text" value="{{$setting['instagram_link']}}" id="example-text-input">
                                            </div>
                                        </div> 
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end"> رابط الواتساب   </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="twitter_link" type="text" value="{{$setting['twitter_link']}}" id="example-text-input">
                                            </div>
                                        </div>
                     
                                        </div>

                                     
                                    
                                    </div><!--end row-->
                                        <div class="form-group mb-3 row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-primary">
                                            تحديث
                                            </button>
                                             
                                        </div>
                                        </div>
                                    </form>
                                        </div>
                                        <div class="tab-pane p-3" id="b" role="tabpanel">
                                         
                                     </div>
                                     <div class="tab-pane p-3" id="c" role="tabpanel">
                                      
                                        <form enctype="multipart/form-data" method="post" action="{{route('settings.update','test')}}">
                                    @csrf 
                                        <div class="row">
                                        
                                        <div class="col-lg-6">
                                       
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">Meta title</label>
                                            <div class="col-sm-9">
                                            <input class="form-control" name="meta_title" type="text" value="{{$setting['meta_title']}}" id="example-text-input">
                                            </div>
                                        </div>
                                         
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">Meta description</label>
                                            <div class="col-sm-9">
                                            <textarea class="form-control" name="meta_description" rows="5" >{{$setting['meta_description']}}</textarea>                                      
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">Meta tage </label>
                                            <div class="col-sm-9">
                                            <input class="form-control" name="meta_tage" type="text" value="{{$setting['meta_tage']}}" id="example-text-input">
                                            </div>
                                        </div>
                     
                                        </div>

                                     
                                    
                                    </div><!--end row-->
                                        <div class="form-group mb-3 row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-primary">
                                            تحديث
                                            </button>
                                             
                                        </div>
                                        </div>
                                    </form>
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
 
  
<script src="https://cdn.tiny.cloud/1/2yd8ex62k92msjoitswpr30ehq2593t264d1ymj1refsitis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
   
  
<script>tinymce.init({selector:'#textarea'});</script>
<script>tinymce.init({selector:'#textarea1'});</script>
<script>tinymce.init({selector:'#textarea2'});</script>
<script>tinymce.init({selector:'#textarea3'});</script>
<script>tinymce.init({selector:'#textarea4'});</script>
        
@endpush