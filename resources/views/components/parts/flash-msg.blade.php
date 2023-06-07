@if(Session::has('flash_msg'))
    <div class="flash_msg">
        <div> </div>
        <div>{{ \Session::get('flash_msg') }}</div>
        <div class="flash_close">×</div>
    </div>
@endif
@if(Session::has('flash_alert'))
    <div class="flash_alert">
        <div> </div>
        <div>{{ \Session::get('flash_alert') }}</div>
        <div class="flash_close">×</div>
    </div>
@endif
