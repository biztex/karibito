@if(Auth::user()->is_ban === 1)
    <div class="unregisteredP limit_acount">
        <div> </div>
        <div>現在当アカウントは利用制限されています。
            <a href="{{route('contact')}}"  class="" style="width: 100px;">問い合わせる</a>
        </div>
        <div class=""></div>
    </div>
@endif
