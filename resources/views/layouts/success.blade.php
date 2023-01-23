@if (\Session::has('success'))



    <div class="alert alert-success border-0 alert-dismissible">
        {!! \Session::get('success') !!}
    </div>
@endif