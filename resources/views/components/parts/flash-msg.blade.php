@if(Session::has('flash_msg'))
    <div class="flash_msg">
        <div> </div>
        <div>{{ \Session::get('flash_msg') }}</div>
        <div class="flash_close">×</div>
    </div>
@endif