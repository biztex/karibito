@if(empty(Auth::user()->userProfile->identification_path))
    <div class="unregisteredP js-unregisteredP">
        <div> </div>
        <div>△サービスの登録には身分証明書の登録が必要です。 <a href="#fancybox_register"  class="fancybox fancybox_register">登録する</a></div>
        <div class="pop_close">×</div>
    </div>
@endif