@if(isset($job_request->user))
<div class="modal hidden">
    <button class="modal__close" type="button"><span class="modal__close--icon">&times;</span></button>
    <div class="modal__box">
        <div class="shareSnsEmail">
            <h3>SNSやメールでサービスをシェアする</h3>
            <div class="sns">
                <a href="http://www.facebook.com/share.php?u={{ urlencode($url) }}" target="_blank"><img src="/img/mypage/ico_facebook.svg" alt=""></a>
                <a href="https://social-plugins.line.me/lineit/share?url={{ urlencode($url) }}" target="_blank"><img src="/img/mypage/ico_line.svg" alt=""></a>
                <a href="https://twitter.com/share?url={{ urlencode($url) }}&text={{ urlencode($job_request->title . ' | ' . $job_request->user->name . ' | カリビトのサービスをシェア') }}&hashtags=karibito" target="_blank"><img src="/img/mypage/ico_twitter.svg" alt=""></a>
                <a href="mailto:?subject=カリビトのサービスをシェア&body={{ urlencode($job_request->title . ' | ' . $job_request->user->name . ' | カリビトのリクエストをシェア ' . $url) }}" target="_blank"><img src="/img/mypage/ico_mail.svg" alt=""></a>
            </div>

            {{-- 招待コード --}}
            @isset(Auth::user()->userProfile)
                <x-parts.invitation-code/>
            @endisset
        </div>
    </div>
</div>
<div class="overlayDetail"></div>
@endif
