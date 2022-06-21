<x-layout>
	<article>
    <div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('service') }}">サービスを探す</a>　>　<a href="#">デザイン</a>　>　<a href="#">その他デザイン</a>　>　<span>似顔絵イラスト描きます</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="{{ route('post') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
		<div id="contents" class="detailStyle">
			<div class="inner02 ">
				<div class="clearfix">
				<div id="main">
					<div class="title">
						<div class="fun">
							<div class="single">
								<a href="#" tabindex="0">対面</a>
							</div>
							<a href="#" class="favorite">お気に入り(11)</a>
						</div>
						<div class="datas">
							<span class="data">電話相談の受付：あり</span>
							<span class="data">閲覧：1000</span>
							<span class="data">エリア：〇〇〇〇</span>
							<span class="data">販売数：無制限</span>
						</div>
						<h2><span>似顔絵イラスト描きます</span></h2>
					</div>
					<div class="slider">
						<div class="big">
						@for($i = 0; $i < 10; $i++)
							<div class="item"><img id="preview_slider{{$i}}" style="aspect-ratio:16/9; object-fit:cover;" src="" srcset="" alt=""></div>
						@endfor
						</div>
						<div class="small">
						@for($i = 0; $i < 10; $i++)
							<div class="item"><img id="preview_slider{{$i.$i}}" style="aspect-ratio:16/9; object-fit:cover;" src="img/service/img_slider_small.jpg" alt=""></div>
						@endfor
						</div>						
					</div>
					<div class="content">
						<h2 class="hdM">サービス内容</h2>
						<p>おかげさまで今年で8年目を迎え、販売実績数が1000件を突破いたしました！<br>引き続き価格以上のデザインを提供できるように頑張ります！</p>
						<p>プロフィールページ「ポートフォリオ」にて実績を掲載しております、<br>ご依頼の検討、仕上がりイメージ、テイストなどの参考にご覧ください：）<br>企業・個人・店舗・サービスやアプリ・ブランドロゴまで、何でも安心してご依頼くださいませ。</p>
						<p>＼販売８年目！選ばれ続ける0つの理由／</p>
						<p>❶初稿【３案】製作<br>同サービスの中でもトップクラスの『３案』ご提案。色々なデザイン案を見た上で選びたい人にぴったりです。さらに、作り直し・修正も無料ですので、実質無制限にデザインの検討が可能です！</p>
						<p>❷細かい修正・大幅な修正まで無制限対応</p>
						<p>❸aiデータ納品<br>他サービスでは有料オプションとして提供されることが多い、Aiデータ（印刷物などに必要なロゴ原本データ）も含まれます。</p>
						<p>❹初稿時キャンセル保証付<br>デザインには相性のようなものが少なからず存在します。<br>修正は無制限ではございますが、初稿を見た上でその後の修正に可能性を感じなかったり、テイストが合わないなど判断された場合は、相談の上無料でキャンセルを受け付けております。</p>
						<p>❺充実のアフターサポート<br>納品後もデザインの修正対応からその他制作物に関するご相談・アドバイスまで、専属のデザイナーとして半永久的にサポートさせていただきます！</p>
					</div>
					<div class="optional">
						<h2 class="hdM">オプション追加料金</h2>
						<ul>
							<li><span class="add">＋ 新規１案デザイン製作</span><span class="price">￥10,000</span></li>
							<li><span class="add">＋ ヒアリング完了後、翌日初稿提出</span><span class="price">￥10,000</span></li>
							<li><span class="add">＋ イラストデザイン初稿提案数１案追加</span><span class="price">￥10,000</span></li>
							<li><span class="add">＋ 新規追加オプション</span><span class="price">￥10,000</span></li>
							<li><span class="add">＋ 新規追加オプション</span><span class="price">￥10,000</span></li>
						</ul>
					</div>
					<div class="optional faq">
						<h2 class="hdM">よくあるご質問</h2>
						<ul class="toggleWrapPC">
							<li>
								<p class="quest toggleBtn"><span>どんな方におすすめですか？</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">どんな方におすすめですかどんな方におすすめですかどんな方におすすめですかどんな方におすすめですか</p>
							</li>
							<li>
								<p class="quest toggleBtn"><span>質問内容が入ります質問内容が入ります</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります</p>
							</li>
							<li>
								<p class="quest toggleBtn"><span>質問内容が入ります質問内容が入ります</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります</p>
							</li>
							<li>
								<p class="quest toggleBtn"><span>質問内容が入ります質問内容が入ります</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります</p>
							</li>
							<li>
								<p class="quest toggleBtn"><span>質問内容が入ります質問内容が入ります</span><span class="more">回答を見る</span></p>
								<p class="answer toggleBox">質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります質問内容が入ります</p>
							</li>
						</ul>
					</div>
				</div>
				<aside id="side" class="pc">
					<div class="box reservate">
						<h3>15,000円</h3>
						<p class="status">予約状況</p>
						<p class="date">5日</p>
						<div class="calendar"><div id="datepicker"></div></div>
					</div>
					<div>
						<div class="peace">
							<h3>カリビト安心への取り組み</h3>
							<p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
						</div>
						<div class="functeBtns">
							<a href="javascript:history.back();" class="orange_o">編集画面に戻る</a>
						</div>
					</div>
					<div class="box seller">
						<h3>スキル出品者</h3>
						<a href="#" class="head"><img src="img/common/ico_head.png" alt=""></a>
						<p class="login">最終ログイン：8時間前</p>
						<p class="introd"><a href="#" class="name">クリエイター名</a><br>(女性/ 20代/ 東京都)</p>
						<div class="evaluate three"></div>
						<p class="check"><a href="#">本人確認済み</a></p>
					</div>
				</aside>
            </div>
        </div><!--inner-->
    </article>
</x-layout>
<script type="text/javascript">
	$(function(){
		$( "#datepicker" ).datepicker();
	});

	var _content = [];
	var moreload = {
		_default:5, // 初期化により5つのメッセージが表示されます
		_loading:3, // 一度にさらに3つのアイテムを表示する
		init:function(){
			var lis = $(".clientEvaluate .ftBox li");
			$(".clientEvaluate ul").html("");
			for(var n=0;n<moreload._default;n++){
				lis.eq(n).appendTo(".clientEvaluate ul");
			}
			for(var i=moreload._default;i<lis.length;i++){
				_content.push(lis.eq(i));
			}
			$(".clientEvaluate .ftBox").html("");
		},
		loadMore:function(){
			var mLis = $(".clientEvaluate li").length;
			for(var i =0;i<moreload._loading;i++){
				var target = _content.shift();
				if(!target){
					$('.clientEvaluate .more').html("").addClass('load');
					break;
				}
				$(".clientEvaluate ul").append(target);
			}
		}
	}
	moreload.init();
</script>