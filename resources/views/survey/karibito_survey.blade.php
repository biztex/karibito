<x-layout>
    <x-parts.post-button/>{{--投稿ボタンの読み込み--}}
    <article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>カリビトアンケート</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<p class="logoTit"><img src="/img/cancel/logo_ttl.svg" alt="LOGO"></p>
					<div class="questionnaire">
						<h3><span>カリビトアンケート</span></h3>
						<p>カリビトアンケートをご利用いただき誠にありがとうございます。<br>本アプリにつきまして改善点などご要望等ございましたら<br>下記よりご連絡ください。<br>今後ともどうぞよろしくお願い致します。</p>
					</div>
                    <form id="form" action="{{ route('survey.store', $chatroom) }}" method="POST" enctype="multipart/form-data">
					@csrf
                        <div class="evaluation">
                            <p class="scroe"><span>アンケートを送信いただけますと<br>もれなくカリビト<big>100円</big>OFFクーポンプレゼント！！</span></p>
                            <p class="stars">カリビトを５つ星で評価ください</p>
                            @error('star')<div class="alert alert-danger" style="text-align:center">{{ $message }}</div>@enderror
                            <div class="rate-form">
                                <input id="star5" type="radio" name="star" value="5">
                                <label for="star5">★</label>
                                <input id="star4" type="radio" name="star" value="4">
                                <label for="star4">★</label>
                                <input id="star3" type="radio" name="star" value="3">
                                <label for="star3">★</label>
                                <input id="star2" type="radio" name="star" value="2">
                                <label for="star2">★</label>
                                <input id="star1" type="radio" name="star" value="1">
                                <label for="star1">★</label>
                            </div>
                            <div class="write">
                                <p>評価コメントを記入しましょう</p>
                                @error('comment')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                <textarea name="comment">{{ old('comment') }}</textarea>
                                <input type="hidden" name="chatroom_id" value="{{ $chatroom->id }}">
                                <input type="hidden" name="reference_id" value="{{ $chatroom->reference_id }}">
                                <input type="hidden" name="reference_type" value="{{ $chatroom->reference_type }}">
                            </div>
                        </div>
                        <div class="functeBtns">
                            <input type="submit" class="red loading-disabled" value="アンケート内容を送信する">
                        </div>
                    </form>
				</div>
			</div>
		</div><!-- /#contents -->
	</article>
</x-layout>
