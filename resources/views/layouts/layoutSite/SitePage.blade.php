
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alwan Altaif</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/images/load.ico')}}">
    @notifyCss

    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap.rtl.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/bootstrap-icons-1.9.1/bootstrap-icons.css')}}">
    <link href="{{asset('/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/owl.theme.default.min.css')}}" rel="stylesheet">

    <link href="{{asset('/css/style.css')}}" rel="stylesheet">

    </head>
<body dir="rtl">
    <div id="load_screen"><!--inide body dircte-->
        <div id="loading"><img src="{{asset('/images/load.png')}}" class="loader" style="width:120px;height:120px;" /></div>
    </div>
    @include('layouts.layoutSite.Header')
    <main>
    <x:notify-messages />
@yield('content')

  </main>
  @include('layouts.layoutSite.Footer')
  @notifyJs
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <script src="{{asset('/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('/js/bootstrap.bundle.js')}}"></script>
  <script src="{{asset('/js/popper.min.js')}}"></script>
  <script src="{{asset('/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('/js/script.js')}}?<?=time()?>"></script>
 

  @stack('js')
  <script>
$('#subscriber_btn').on('click' , function (e) {
            
           // $(document).find('#errsu').remove();
            e.preventDefault();
             $('#errsu').remove();
            $.ajax({
                type: "post",
                url: "{{ route('subscriber') }}",
                data: $("#subscriber").serialize(),
                dataType: 'json',              // let's set the expected response format
                success: function (data) {
                    //console.log(data);
                    $('#success_message_subscriber').fadeIn().html('<div class="alert alert-success border-0 alert-dismissible">' + data.message +'</div>');
                    // document.body.scrollTop = document.documentElement.scrollTop = 0;
                    document.getElementById('a1').value = '';
                   


                },
                error: function (err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                         
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                           //el.nextAll().remove();
                            el.after($('<span id="errsu" style="color: red;">' + error[0] + '</span>'));
                        });
                    }
                }
            });

        });
</script>
  </body>
  </html>