@if(Auth::user()->userProfile->is_identify === 2 || (Auth::user()->userProfile->is_identify === 0 && Auth::user()->userProfile->identification_path === null))
    <div class="unregisteredP incomplete js-unregisteredP">
        <div class="incompleteId">
            <img src="./img/common/ico_id.png" class="incompleteIdIcon">{{-- サービスの登録には --}}本人確認未完了<a href="#fancybox_register" class="fancybox fancybox_register">登録する</a>
        </div>
        <div class="pop_close">×</div>
    </div>
@endif