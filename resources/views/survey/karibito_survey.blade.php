<x-layout>
    <x-parts.post-button/>{{--投稿ボタンの読み込み--}}
    <article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="index.html">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
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
                    <form action="{{ route('survey.store', $chatroom) }}" method="POST" enctype="multipart/form-data">
					@csrf
                        <div class="evaluation">
                            <!-- star選択素材がなかったので仮で作ってます -->
                            <div class="mypageEditInput flexLine02">
                                <select name="star">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <p class="scroe"><span>アンケートを送信いただけますと<br>もれなくカリビトポイント<big>50PT</big>プレゼント！</span></p>
                            <p class="stars">カリビトを５つ星で評価ください。<img src="/img/cancel/ico_5stars.svg" alt=""></p>
                            <div class="write">
                                <p>評価コメントを記入しましょう</p>
                                @error('comment')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                <textarea name="comment">{{ old('comment') }}</textarea>
                                <input type="hidden" name="chatroom_id" value="{{ $chatroom->id }}">
                            </div>
                        </div>
                        <div class="functeBtns">
                            <input type="submit" class="red" value="アンケート内容を送信する">
                        </div>
                    </form>
				</div>
			</div>
		</div><!-- /#contents -->
	</article>
</x-layout>
