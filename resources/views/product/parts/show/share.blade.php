<div class="modal hidden">
    <button class="modal__close" type="button"><span class="modal__close--icon">&times;</span></button>
    <div class="modal__box">
        <div class="shareSnsEmail">
			@if(isset($product->user))
				<h3>SNSやメールでサービスをシェアする</h3>
				<div class="sns">
					<a href="http://www.facebook.com/share.php?u={{ $url }}" target="_blank"><img src="/img/mypage/ico_facebook.svg" alt=""></a>
					<a href="https://social-plugins.line.me/lineit/share?url={{ $url }}" target="_blank"><img src="/img/mypage/ico_line.svg" alt=""></a>
					<a href="https://twitter.com/share?url={{ $url }}&text={{ $product->title }} %20%7C%20 {{ $product->user->name }} %20%7C%20 カリビトのサービスをシェア&hashtags=karibito" target="_blank"><img src="/img/mypage/ico_twitter.svg" alt=""></a>
					<a href="mailto:?subject=カリビトのサービスをシェア&body={{ $product->title }} %20%7C%20 {{ $product->user->name }} %20%7C%20 カリビトのサービスをシェア {{ $url }}" target="_blank"><img src="/img/mypage/ico_mail.svg" alt=""></a>
				</div>

				{{-- 招待コード --}}
				@isset(Auth::user()->userProfile)
					<x-parts.invitation-code/>
				@endisset
			@else
				<p>このユーザーは退会しました。</p>
			@endif
		</div>
	</div>
</div>
<div class="overlayDetail"></div>
