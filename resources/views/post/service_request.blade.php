<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　&gt;　<span>サービスをリクエストする</span>
			</div>
		</div>
		<div class="btnFixed"><a href="{{ route('post') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<h2 class="subPagesHd">サービスをリクエストする<a href="{{ route('support') }}" class="more checkGuide">カリビト安心サポートをご確認ください</a></h2>
					<form class="contactForm">
						<p class="th">カテゴリ<span class="must">必須</span></p>
						<div class="td">
							<select>
								<option>選択してください</option>
								<option>item01</option>
								<option>item02</option>
							</select>
						</div>
						<p class="th">商品名<span class="must">必須</span></p>
						<div class="td">
							<input type="text" >
						</div>
						<p class="th">商品の詳細<span class="must">必須</span></p>
						<div class="td">
							<textarea></textarea>
						</div>
						<p class="th">予算<span class="must">必須</span></p>
						<div class="td">
							<p class="budget"><input type="text" value="0"></p>
							<div class="warnNotes">
								<p>【対面】：直接会って提供する内容を相手に行います。<br>【非対面】：互いが直接会わずに提供する内容を相手に行います。</p>
							</div>
						</div>
						<p class="th">応募期限<span class="must">必須</span></p>
						<div class="td">
							<input type="date">
						</div>
						<p class="th">納期希望日</p>
						<div class="td">
							<input type="date">
						</div>
						<p class="th">仕事体系<span class="must">必須</span></p>
						<div class="td">
							<select>
								<option>選択してください</option>
								<option>item01</option>
								<option>item02</option>
							</select>
						</div>
						<p class="th">エリア（対面の場合のみ）</p>
						<div class="td">
							<select>
								<option>選択してください</option>
								<option>item01</option>
								<option>item02</option>
							</select>
						</div>
						<p class="th">電話相談の受付<span class="must">必須</span></p>
						<div class="td">
							<select>
								<option>選択してください</option>
								<option>item01</option>
								<option>item02</option>
							</select>
						</div>
						<div class="functeBtns">
							<a href="{{ route('service_preview') }}" class="full">プレビュー画面を見る</a>
							<a href="{{ route('service_thanks') }}" class="full green">サービス提供を開始</a>
							<a href="{{ route('draft') }}" class="full green_o">下書きとして保存</a>
						</div>
					</form>
				</div>
			</div><!--cancelWrap-->

		</div>
	</article>
</x-layout>