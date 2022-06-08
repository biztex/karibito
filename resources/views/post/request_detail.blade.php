<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('request') }}">リクエストを探す</a>　>　<a href="#">デザイン</a>　>　<a href="#">その他デザイン</a>　>　<span>似顔絵イラスト描きます</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
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
						</div>
					</div>
					<div class="drawIllustration">
						<h2 class="hdM">似顔絵イラスト描きます</h2>
						<table>
							<tr>
								<th><span class="th">予算</span></th>
								<td><big>5,000円〜</big></td>
							</tr>
							<tr>
								<th><span class="th">残り時間</span></th>
								<td><big>1日と10時間</big></td>
							</tr>
							<tr>
								<th><span class="th">納品希望日</span></th>
								<td>2022年5月4日</td>
							</tr>
							<tr>
								<th><span class="th">掲載日</span></th>
								<td>2022年5月4日</td>
							</tr>
							<tr>
								<th><span class="th">締切日</span></th>
								<td>2022年5月20日</td>
							</tr>
							<tr>
								<th><span class="th">提案人数</span></th>
								<td>20人</td>
							</tr>
						</table>
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
							<a href="" class="orange full">交渉画面へ進む</a>
						</div>
						<p class="specialtyBtn"><span>この情報をシェアする</span></p>
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
		</div><!-- /#contents -->
	</article>
</x-layout>
<script type="text/javascript">
	$(function(){
		$( "#datepicker" ).datepicker();
	});

	var _content = [];
	var moreload = {
		_default:5,//初始化显示5条信息
		_loading:3, //每次显示3条更多内容
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