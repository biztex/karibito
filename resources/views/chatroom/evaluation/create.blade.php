<x-layout>
    <article>
    	<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('chatroom.index') }}">やりとり一覧</a>　>　
                <a href="{{ route('chatroom.show', $chatroom->id) }}">{{ $chatroom->referencePurchased->title }}</a>　>　
				<span>評価</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
			<div class="cancelWrap">
				<div class="inner inner05">
					<div class="cancelTitle">
						<h2>評価を入力しましょう！</h2>
					</div>
                    <div class="cancelSubText">
                        @if($chatroom->status === App\Models\Chatroom::STATUS_BUYER_EVALUATION)
                            <p>取引完了の確認にチェックを入れて、出品者の方の評価を行ってください。</p>
                        @elseif($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)
                            <p>
                                取引完了の確認にチェックを入れて、購入者の方の評価を行ってください。<br />
                                双方の評価をもって取引完了となり、売上金が計上されます。
                            </p>
                        @endif
                    </div>
					<form id="form" action="" method="post">
					@csrf
						<div class="cancelRea">
							@error('checkbox')<div class="alert alert-danger" style="text-align:center">{{ $message }}</div>@enderror
							<p class="reason checkChoice"><label><input type="checkbox" name="checkbox" required>取引を完了します</label></p>
							@error('star')<div class="alert alert-danger" style="text-align:center">{{ $message }}</div>@enderror
                            <div class="radioChoice rateTitle">総合評価　＊必須</div>
							<div class="radioChoice rate">
								<label class="good">良かった<input type="radio" name="star" @if(old('star') == App\Models\Evaluation::GOOD || old('star') === null) checked @endif value="{{App\Models\Evaluation::GOOD}}"></label>
								<label class="usually">普通<input type="radio" name="star" @if(old('star') == App\Models\Evaluation::USUALLY) checked @endif value="{{App\Models\Evaluation::USUALLY}}"></label>
								<label class="pity">残念だった<input type="radio" name="star" @if(old('star') == App\Models\Evaluation::PITY) checked @endif value="{{App\Models\Evaluation::PITY}}"></label>
							</div>
						</div>
						<div class="evaluation">
							@error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <p>評価コメント　＊必須</p>
							<textarea name="text" onkeyup="ShowLength(value);">{{ old('text') }}</textarea>
							<p class="max-string" id="inputlength">{{ mb_strlen(old('text')) }}/255</p>
						</div>
                        <!-- 一旦コメントアウト -->
                        <div class="warnNotes">
                            <p>こちらの評価は、取引完了後に評価一覧で公開されます。</p>
                            <p>
                            @if($chatroom->status === App\Models\Chatroom::STATUS_BUYER_EVALUATION)
                                他の方の購入時の判断材料にもなりますので、丁寧に記入しましょう。
                            @elseif($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)
                                他の方の契約時の判断材料にもなりますので、丁寧に記入しましょう。
                            @endif
                            </p>
                            <p>過度な批判や誹謗中傷などは、ガイドライン違反として利用制限やアカウント停止の対象となりますのでご注意ください。</p>
                            <p class="colorRed">注意！ 評価後は変更や削除は出来ません。</p>
                        </div>
						<div class="functeBtns">
							@if($chatroom->status === App\Models\Chatroom::STATUS_BUYER_EVALUATION)
								<input type="submit" class="red loading-disabled" value="評価を送信する" formaction="{{route('chatroom.buyer.evaluation', $chatroom->id)}}">
							@elseif($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)
								<input type="submit" class="red loading-disabled" value="評価を送信する" formaction="{{route('chatroom.seller.evaluation', $chatroom->id)}}">
							@endif
						</div>
					</form>
					<!-- 一旦コメントアウト -->
					<!-- <div class="warnNotes">
						<p class="danger">ご注意！</p>
						<p>※他のクーポンと併用はできません。</p>
					</div> -->
				</div>
			</div>
		</div>
    </article>
</x-layout>

<script>
    // 打ち込んだ文字数の表示
    function ShowLength( str ) {
        document.getElementById("inputlength").innerHTML = str.length + "/255";
    }
</script>
