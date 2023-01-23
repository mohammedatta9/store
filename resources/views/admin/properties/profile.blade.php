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
                            <h4 class="page-title">property detail</h4>
                            <h6 class=" client-name fw-bold">BY : {{$property->user->fname}} {{$property->user->lname}}</h6>
                            <h6 class=" client-name fw-bold">likes : {{$property->like->count()}} </h6>

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
                                           aria-selected="true">Eitd property</a>
                                    </li>
                                    
                                    
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane p-3 active" id="Post" role="tabpanel">

                                     <form name="" method="post" action="{{ route('admin.property.edit') }}"   enctype= "multipart/form-data" >
                                     @csrf
                                     <input   type="text" name="id" value="{{$property->id}}"  style="display:none;">

                                        <div class="row">
                                        
                                        <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label  class="col-sm-3 "></label>
                                            <div class="col-sm-9">
                                            <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" value="1" name="featured" type="checkbox"  @if($property->featured == 1 ) checked="checked" @endif>
                                            <label class="form-check-label" for="customSwitchSuccess">Featured property</label>
                                        </div>
                                     </div>
                                        </div><br>
                                        <div class="mb-3 row">
                                        @error('title')
                                                <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">Tilte</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="title" type="text" value="{{$property->title}}" id="example-text-input"  maxlength="100">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                        @error('description')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                            <label   class="col-sm-3 col-form-label text-end">Description</label>
                                            <div class="col-sm-9">
                                            <textarea class="form-control" name="description" rows="5" maxlength="300" >{{$property->description}}</textarea>                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                        @error('price')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                            <label   class="col-sm-3 col-form-label text-end">price</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="price" type="number"  maxlength="100"  @if($property->price) value="{{$property->price}}" @else value="0" @endif  >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">Currency</label>
                                            <div class="col-sm-9">
                                            <select class="form-control"  name="currency_id">
                                                @if( $property->currency_id )
                                            <option value="{{$property->currency_id}}" selected>{{$property->currency->name}}</option>@endif
                                                    <option value="1">دينار</option>
                                                    <option value="2"> دولار</option>
                                                </select>                                            </div>
                                        </div>   
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">price description</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="price_description"  maxlength="100" value="{{$property->price_description}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">tax</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="tax" type="text"  maxlength="100" value="{{$property->tax}}" >
                                            </div>
                                        </div>    
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">category</label>
                                            <div class="col-sm-9">
                                            <select class="form-control"  name="category_id">
                                                     
                                                     @if( $property->category_id )
                                                     <option value="{{$property->category_id}}" selected>{{$property->category->name}}</option>@endif
                                                     <option value="2">للتأجير</option>
                                                     <option value="1">للبيع</option>
                                                 </select>                                           </div>
                                        </div>   
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">type</label>
                                            <div class="col-sm-9">
                                            <select class="form-control"  name="type_id">
                                                    <option>النوع</option>
                                                    @foreach($types as $ty)
                                                    <option value="{{$ty->id}}"
                                                    {{ $property->type_id == $ty->id ? 'selected' : '' }}  >{{$ty->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                                   
                                    </div>
                                    
                                    <div class="col-lg-6">
                                         
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end"></label>
                                            <div class="col-sm-9">
                                            @if($property->main_image)
                                            <img src="{{asset('/storage/property/'.$property->main_image)}}"   alt="{{$property->title}}" width="100">
                                            @endif
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">Change cover</label>
                                            <div class="col-sm-9">
                                            <input type="file" name="main_image" class="form-control"  />   
                                             </div>
                                        </div> 
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">Add Images</label>
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
                                                <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">  Images</label>
                                            <div class="col-sm-9">
                                        <table >@foreach($property->album as $a)
                                                            <tr class="R_album{{$a->id}}">
                                                                    <td> <img src="{{asset('/storage/property/'.$a->name)}}"  alt="{{$a->name}}" width="150"  > </td> 
                                                                    <td> <span> <a href="#!" class="deletem_b" deletem_b="{{$a->id}}"> ازالة الصورة </a></span></td>
                                                                   
                                                            </tr> @endforeach
                                                        </table></div>
                                        </div><br>
                                        </div> 
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">video link</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="video_link" type="text"  maxlength="100" value="{{$property->video_link}}"  >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">Address</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="address" type="text"  maxlength="100" value="{{$property->address}}"  >
                                            </div>
                                        </div>   
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">country</label>
                                            <div class="col-sm-9">
                                            @error('country_id')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                            <select class="form-control"  id="country_id" name="country_id" required>
                                                    <option>الدولة</option>
                                                    @foreach($countries as $co)
                                                    <option value="{{$co->id}}"
                                                    {{ $property->country_id == $co->id ? 'selected' : '' }}  >{{$co->name}}</option>
                                                    
                                                    @endforeach
                                                </select>        
                                           </div>
                                        </div> 
                                        <div class="mb-3 row">
                                            <label   class="col-sm-3 col-form-label text-end">city</label>
                                            <div class="col-sm-9">
                                            @error('city_id')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                            <select class="form-control" name="city_id" id="city_id" >
                                            @if( $property->city_id )
                                                    <option value="{{$property->city_id}}" selected>{{$property->city->name}}</option>@endif
                                             </select>       
                                           </div>
                                        </div>  
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">street</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="street" type="text" value="{{$property->street}}"  maxlength="100" id="example-text-input">
                                            </div>
                                        </div>                
                                    </div> 
                                    <div class="col-lg-12">
                                            <div class="property-details-google-map mb-60">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9334.271551495209!2d-73.97198251485975!3d40.668170674982946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25b0456b5a2e7:0x68bdf865dda0b669!2sBrooklyn%20Botanic%20Garden%20Shop!5e0!3m2!1sen!2sbd!4v1590597267201!5m2!1sen!2sbd" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                            </div> </div>
                                            <div class="col-lg-6">
                                            <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">Latitude</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="lot" type="text" value="{{$property->lot}}"  maxlength="100" id="example-text-input">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">Longitude</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="lag" type="text" value="{{$property->lag}}"  maxlength="100" id="example-text-input">
                                            </div>
                                        </div>
                                        </div>  
                                    
                                    <div class="col-lg-6">
                                        
                                        <div class="mb-3 row">
                                        @error('space')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">space</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="space" type="number"  maxlength="100" @if($property->space) value="{{$property->space}}" @else value="0" @endif id="example-text-input">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                             @error('number_rooms')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">number rooms</label>
                                            <div class="col-sm-9">
                                            <select class="form-control"  name="number_rooms">
                                                    <option  value ="0">number rooms</option>
                                                    @if( $property->number_rooms )
                                                    <option value="{{$property->number_rooms}}" selected>{{$property->number_rooms}}</option>@endif

                                                     <option value ="1">1</option>
                                                    <option value ="2">2</option>
                                                    <option value ="3">3</option>
                                                    <option value ="4">4</option>
                                                    <option value ="5">5</option>
                                                    <option value ="6">6</option>
                                                    <option value ="7">7</option>
                                                    <option value ="8">8</option>
                                                    <option value ="9">9</option>
                                                    <option value ="10">10</option>
                                                    <option value ="11">11</option>
                                                </select>                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">number bedrooms</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="number_bedrooms" type="number"  maxlength="100" value="{{$property->number_bedrooms}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">number toilets</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="number_toilets" type="number"  maxlength="100" value="{{$property->number_toilets}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">garage space </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="garage_space" type="text" value="{{$property->garage_space}}"  maxlength="100" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">built year</label>
                                            <div class="col-sm-9">
                                            <select class="form-control" name="built_year">
                                                @if( $property->built_year )
                                                    <option value="{{$property->built_year}}" selected>{{$property->built_year}}</option>@endif
                                                    <option  value="">سنة الإنشاء</option>
                                                    <option value="1980">1980</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1999">1999</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                 </select>                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">Available from</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="available_from" type="date" value="{{$property->available_from}}" id="example-text-input">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">basement space</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="basement_space" type="number" value="{{$property->basement_space}}"  maxlength="100" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">extra details</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="extra_details" type="text" value="{{$property->extra_details}}"  maxlength="200" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">roof space</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="roof_space" type="number" value="{{$property->roof_space}}"  maxlength="100" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">floor no</label>
                                            <div class="col-sm-9">
                                            <select class="form-control" name="floor_no">
                                                    <option  value ="">floor_no</option>
                                                    @if( $property->floor_no )
                                                    <option value="{{$property->floor_no}}" selected>{{$property->floor_no}}</option>@endif
                                                    <option value ="0">Not Available</option>
                                                    <option value ="1">1</option>
                                                    <option value ="2">2</option>
                                                    <option value ="3">3</option>
                                                    <option value ="4">4</option>
                                                    <option value ="5">5</option>
                                                    <option value ="6">6</option>
                                                    <option value ="7">7</option>
                                                    <option value ="8">8</option>
                                                </select>                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">number floors</label>
                                            <div class="col-sm-9">
                                            <select class="form-control" name="number_floors">
                                                    <option  value ="">number_floors</option>
                                                    @if( $property->number_floors )
                                                    <option value="{{$property->number_floors}}" selected>{{$property->number_floors}}</option>@endif
                                                    <option value ="0">Not Available</option>
                                                     <option value ="1">1</option>
                                                    <option value ="2">2</option>
                                                    <option value ="3">3</option>
                                                    <option value ="4">4</option>
                                                    <option value ="5">5</option>
                                                    <option value ="6">6</option>
                                                    <option value ="7">7</option>
                                                    <option value ="8">8</option>
                                                </select>                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-3 col-form-label text-end">owner note</label>
                                            <div class="col-sm-9">
                                            <textarea class="form-control" name="owner_note" rows="4"  maxlength="300">{{$property->owner_note}}</textarea>                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Amenities</h6>  
                                     <div class="row">                                
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="ماء" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'ماء') checked @endif @endforeach @endif  >  
                                            <label class="checkbox-item">ماء
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="كهرباء" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'كهرباء') checked @endif @endforeach @endif  >
                                            <label class="checkbox-item">كهرباء
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="صالة رياضة" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'صالة رياضة') checked @endif @endforeach @endif  >
                                            <label class="checkbox-item">صالة رياضة
                                             </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="مصلى" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'مصلى') checked @endif @endforeach @endif  >
                                            <label class="checkbox-item">مصلى
                                            </label>
                                        </div>
                                                                     
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="خدمات صيانة" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'خدمات صيانة') checked @endif @endforeach @endif  >
                                            <label class="checkbox-item">خدمات صيانة
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="تلفون" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'تلفون') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">تلفون
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="مصعد" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'مصعد') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">مصعد
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="انترنت" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'انترنت') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">انترنت
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="حماية نوافذ" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'حماية نوافذ') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">حماية نوافذ
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="موقف سيارات" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'موقف سيارات') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">موقف سيارات
                                            </label>
                                        </div>
                                                                   
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="مكيف" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'مكيف') checked @endif @endforeach @endif  >
                                            <label class="checkbox-item">مكيف
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="تدفئة" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'تدفئة') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">تدفئة
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="طاقة شمسية" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'طاقة شمسية') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">طاقة شمسية
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="مسموح للكلاب" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'مسموح للكلاب') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">مسموح للكلاب
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <input type="checkbox" name="amenities[]" value="مسموح للقطط" @if($property->amenities) @foreach ($property->amenities as $a) @if ($a == 'مسموح للقطط') checked @endif @endforeach @endif  >

                                            <label class="checkbox-item">مسموح للقطط
                                            </label>
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
</script>
@endpush