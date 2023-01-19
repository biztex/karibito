@if(empty(Auth::user()->userProfile->identification_path))
    <div class="unregisteredP js-unregisteredP">
        <div> </div>
        <div><img src="./img/common/ico_check.png">{{-- サービスの登録には --}}本人確認未完了<a href="#fancybox_register"  class="fancybox fancybox_register">【登録する】</a></div>
        <div class="pop_close">×</div>
    </div>
@endif