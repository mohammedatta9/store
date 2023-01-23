<footer class="container">
      <div class="py-5">
          <div class="row">
            <div class="col-6 col-md-2 mb-3">
              <h5>الأقسام</h5>
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الألواح
              </a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الأجهزة
              </a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الكشافات</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الإنارات</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الحوالات</a></li>
              </ul>
            </div>
      
            <div class="col-6 col-md-3 mb-3">
              <h5>روابط هامة</h5>
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{route('questions')}}" class="nav-link p-0 ">الأسئلة الشائعة
              </a></li>
                <li class="nav-item mb-2"><a href="{{route('register')}}" class="nav-link p-0 ">الاشتراك
              </a></li>
                <li class="nav-item mb-2"><a href="{{route('login')}}" class="nav-link p-0 ">الدخول
              </a></li>
                <li class="nav-item mb-2"><a href="{{route('about')}}" class="nav-link p-0 ">من نحن
              </a></li>
                <li class="nav-item mb-2"><a href="{{route('policy')}}" class="nav-link p-0 ">سياسة الخصوصية
              </a></li>
                <li class="nav-item mb-2"><a href="{{route('Shipping')}}" class="nav-link p-0 ">الشحن والاستلام
              </a></li>
                <li class="nav-item mb-2"><a href="{{route('conditions')}}" class="nav-link p-0 ">الشروط والأحكام</a></li>
              
              </ul>
            </div>
      
            <div class="col-6 col-md-3 mb-3">
              <h5>الاتصال بنا</h5>
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">فرع القرين
              </a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">فرع الجهراء
              </a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">فرع المنقف
              </a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">تليفون: {{$phone}}
              </a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 "> {{$address}}
              </a></li>
                <li class="nav-item mb-2"><a href="{{$email}}" class="nav-link p-0 ">البريد الإلكتروني: </a></li>
  
              </ul>
            </div>
      
            <div class="col-md-4 mb-3">
            <form name="subscriber" id="subscriber" enctype="multipart/form-data" method="post" action="">
                <h5>اشتراك النشرة البريدية</h5>
                <div id="success_message_subscriber"></div>

                <div class="d-flex w-100">
                  <label for="newsletter1" class="visually-hidden"></label>

                            @csrf
                            <input  type="text"name="email" class="form-control border-0"  maxlength="90" id="a1" placeholder="أدخل البريد الإلكتروني">

                                 <div class="btn-wrapper">
                                <button class="btn border-0 btn-subscribe" type="button"  id="subscriber_btn">أشترك الآن</button>

                                 </div>
                         
                 </div>
                <hr class="hr-blue">
              </form>
          <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4">
            <p>جميع الحقوق المحفوظة</p>
            <div class="socials-icons d-flex">
              <a class="bi bi-facebook"></a>
              <a class="bi bi-instagram"></a>
              <a class="bi bi-whatsapp"></a>   
          </div>
          </div>
            </div>
          </div>
      
          
        </div>
  </footer>