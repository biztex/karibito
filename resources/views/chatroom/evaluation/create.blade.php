<x-layout>
    <article>
    	<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<ul class="stepUl">
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">チャット開始</p>
						</li>
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">契約</p>
						</li>
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">作業</p>
						</li>
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">評価</p>
						</li>
					</ul>
					<div class="cancelTitle">
						<h2>評価をお願いします</h2>
					</div>
					<form action="" method="post">
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
							<textarea name="text">{{ old('text') }}</textarea>
						</div>
						<div class="functeBtns">
							@if($chatroom->status === App\Models\Chatroom::STATUS_BUYER_EVALUATION)
								<input type="submit" class="red" value="評価を投稿する" formaction="{{route('chatroom.buyer.evaluation', $chatroom->id)}}">
							@elseif($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)
								<input type="submit" class="red" value="評価を投稿する" formaction="{{route('chatroom.seller.evaluation', $chatroom->id)}}">
							@endif
						</div>
					</form>
					<div class="warnNotes">
						<p class="danger">ご注意！</p>
						<p>※他のクーポンと併用はできません。</p>
					</div>
				</div>
			</div>
		</div>
    </article>
</x-layout>