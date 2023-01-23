@if (\Session::has('error'))



    <div class="alert alert-danger border-0 alert-dismissible">
        {!! \Session::get('error') !!}
    </div>
@endif