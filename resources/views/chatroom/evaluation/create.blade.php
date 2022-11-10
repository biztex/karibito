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
					
					<x-parts.chatroom-step :value="$chatroom"/>

					<div class="cancelTitle">
						<h2>評価をお願いします</h2>
					</div>
					<form id="form" action="" method="post">
					@csrf
						<div class="cancelRea">
							@error('checkbox')<div class="alert alert-danger" style="text-align:center">{{ $message }}</div>@enderror
							<p class="reason checkChoice"><label><input type="checkbox" name="checkbox" required>契約完了を確認しました</label></p>

							@error('star')<div class="alert alert-danger" style="text-align:center">{{ $message }}</div>@enderror
							<div class="radioChoice rate">
								<label class="good">良かった<input type="radio" name="star" @if(old('star') == App\Models\Evaluation::GOOD || old('star') === null) checked @endif value="{{App\Models\Evaluation::GOOD}}"></label>
								<label class="usually">普通<input type="radio" name="star" @if(old('star') == App\Models\Evaluation::USUALLY) checked @endif value="{{App\Models\Evaluation::USUALLY}}"></label>
								<label class="pity">残念だった<input type="radio" name="star" @if(old('star') == App\Models\Evaluation::PITY) checked @endif value="{{App\Models\Evaluation::PITY}}"></label>
							</div>
						</div>
						<div class="evaluation">
							@error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
							<p>評価のコメントを記入しましょう</p>
							<textarea name="text" onkeyup="ShowLength(value);">{{ old('text') }}</textarea>
							<p class="taRResume">255</p>
							<p class="max-string" id="inputlength">/3000</p>
						</div>
						<div class="functeBtns">
							@if($chatroom->status === App\Models\Chatroom::STATUS_BUYER_EVALUATION)
								<input type="submit" class="red loading-disabled" value="評価を投稿する" formaction="{{route('chatroom.buyer.evaluation', $chatroom->id)}}">
							@elseif($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)
								<input type="submit" class="red loading-disabled" value="評価を投稿する" formaction="{{route('chatroom.seller.evaluation', $chatroom->id)}}">
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
        document.getElementById("inputlength").innerHTML = str.length + "/3000";
    }
</script>
