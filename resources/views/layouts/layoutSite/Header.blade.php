
    <header>
      <style>
        html {
                overflow: hidden;
              
            }
      </style>
        <script>
            //always in header
            window.addEventListener("load", function() {
                var load_screen = document.getElementById("load_screen");
                document.body.removeChild(load_screen);
                $("html").css({
                    'overflow': 'auto'
                });
            });
        </script>

        <div class="mobile-nav d-lg-none d-flex justify-content-between align-items-center">
            <button class="btn btn-open-menu bi bi-list"></button>
            <div>
              <a href="/cart" class="position-relative">
                <span class="btn bi bi-cart"></span>
               </a>
              <a href="{{route('wishlist')}}" class="position-relative">
                <span class="btn bi bi-heart"></span>
                <span class="notifications-number   badge rounded-pill">
                @if(Auth::user()) <span class="notifications-number top-0 start-100 badge rounded-pill">{{Auth::user()->like->count()}}</span>
           @endif
                </span>
              </a>
              <a href="{{route('viewMyAccount')}}">
                <span class="btn bi bi-person"></span>
              </a>
            </div>
            
        </div>
    <nav class="border-bottom header-first">
    <div class="container d-flex flex-wrap">
      <ul class="nav ms-auto d-flex align-items-center ms-sm-0 me-auto">
        
       
        <li class="nav-item"><a href="@if(Auth::user()) showorder/{{$order->id}} @else {{route('showorder2')}}@endif" class="nav-link px-2" aria-current="page">
                <span class="bi bi-truck me-2"></span>
                تتبع الطلب
        </a></li>
        <li class="nav-item socials-icons d-flex">
                <a  href="{{$facebook_link}}" class="bi bi-facebook"></a>
                <a  href="{{$instagram_link}}" class="bi bi-instagram"></a>
                <a   href="{{$whatsapp_link}}" class="bi bi-whatsapp"></a>   
       
        </li>
       <li class="nav-item dropdown">
                 
        </li> 
       </ul>
       @if(Auth::user())@else
      <ul class="nav me-sm-0 me-auto">
        <li class="nav-item"><a href="{{route('login')}}" class="nav-link  px-2">تسجيل دخول</a></li>
        <li class="nav-item"><a href="{{route('register')}}" class="nav-link  px-2">الاشتراك</a></li>
      </ul>
      @endif
    </div>
  </nav>
<div class="container header-second d-lg-flex justify-content-between align-items-center py-3">

<div class="px-4 text-center py-4 py-lg-0"><a  href="{{route('viewHomePage')}}"><img src="{{asset('storage/users/'. $header_logo )}}" alt=""></a></div>
<form id="#" action="{{ route('search_property')}}" method="GET">
                        @csrf
<div class="d-none d-lg-block flex-fill px-4 py-4 py-lg-0">
    <div class="btn-group w-100">
    <button type="button" class="btn btn-search bi bi-search border border-end-0 rounded-0 rounded-start"></button>
    <input type="search" class="form-control rounded-0 rounded-end border border-start-0" name="title" aria-label="search" aria-describedby="search">
 
                         
</div>
</div>
        </form>

<div class="d-none d-lg-flex justify-content-center justify-content-lg-end overflow-auto">
    <a href="{{route('viewMyAccount')}}" class="a-header-circles" >
    <div class="div-header-circles me-2">
    <span class="bi bi-person-fill"></span>
    </div>
    <span>حسابي</span>
    </a>
    <a href="{{route('wishlist')}}" class="a-header-circles" >
        <div class="div-header-circles me-2 pt-1">
        
        <span class="bi bi-heart-fill"></span>
        </div>
        <span>المفضلة   </span>
         
        </a>
        <a href="/cart" class="a-header-circles" >
            <div class="div-header-circles cart-header-circles me-2 pt-1">
                <!-- <span class="notifications-number top-0 start-100 badge rounded-pill"> </span> -->
            <span class="bi bi-cart-fill"></span>
            </div>
            <span>السلة   </span>
           
            </a>
</div>

</div>
<div class="overlay-close"></div>
<div class="header-third px-0 py-3 mobile-menu-body ">
    <div  class="container">
<nav class="navbar navbar-expand-lg container p-0">
    <div class="container-fluid collapse navbar-collapse">
      <div class="mobile-menu-header">
        <img src="{{asset('/images/load.png')}}" width="40px" height="40px" alt="">
        <button class="bi bi-x btn-close-menu"></button>
      </div>
        <div class="btn-group w-100 d-flex d-lg-none">
        <button type="button" class="btn btn-search bi bi-search border border-end-0 rounded-0 rounded-start"></button>
        <input type="search" class="form-control rounded-0 rounded-end border border-start-0" aria-label="search" aria-describedby="search">
        </div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('viewHomePage')}}">الرئيسية</a>
          </li>
            @foreach($categories as $category)
            @if($category->categories->count() == 0) 
            @if($category->category_id == null)

            <li class="nav-item">
            <a class="nav-link" href="/category_property/{{$category->id}}">{{$category->name}}</a>
          </li>
          @endif
          @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
            {{$category->name}}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/category_property/{{$category->id}}">{{$category->name}}</a></li>
              @foreach($category->categories as $c)
              <li><a class="dropdown-item" href="/category_property/{{$c->id}}">{{$c->name}}</a></li>
               @endforeach
            </ul>
          </li>
          @endif
          @endforeach

        </ul>
      
    </div>
  </nav>
</div>
</div>
</header> 