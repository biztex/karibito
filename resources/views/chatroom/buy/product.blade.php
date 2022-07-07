<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="index.html">ホーム</a>　>　<span>カリビト知恵袋</span>
            </div>
        </div><!-- /.breadcrumb -->
        <div id="contents" class="otherPage otherPage2">
            <div class="inner02 clearfix">
                <div id="main">

                <!-- 購入した時、表示する出品者情報 -->
                    <div class="friendsTop">
                        <div class="sellerTop">
                            <div class="user">
                                @if(null !== $product->productUser->userProfile->icon)
                                    <p class="head"><img src="{{ asset('/storage/'.$product->productUser->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;border-radius: 50px;"></p>
                                @else
                                    <p class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                                @endif
                                <div class="info">
                                    <p class="name">出品者・{{ $product->productUser->name }}</p>
                                    <p><a href="#" class="link">職務経歴書を見る</a></p>
                                </div>
                            </div>
                            <p class="login">最終ログイン：オンライン中</p>
                        </div>
                    </div>

                    <!-- 購入されたとき、表示する購入者情報 -->
                    <div class="friendsTop">
						<div class="sellerTop">
							<div class="user">
								<p class="head"><img src="img/service/ico_head.png" alt=""></p>
								<div class="info">
									<p class="name">購入者の名前</p>
								</div>
							</div>
							<p class="login">最終ログイン：オンライン中</p>
						</div>
					</div>

                    <h2 class="hdM">チャット<a href="#" class="more st2">契約後のキャンセルについて</a></h2>
                    <div class="subPagesTab">
                        <div class="chatPages">
                            <div class="item">
                                <div class="warnBox">
                                    <p class="tit">取引内容を入力し交渉をしましょう</p>
                                    <p>履歴を残すため、カリビト内でのやりとりを推奨しております。</p>
                                    <p class="note">※返信は3日以内にお願いします</p>
                                </div>
                                <ul class="communicate">

                                
                                    <!-- 通常メッセージ -->
                                    <li>
                                        <div class="img">
                                            @if(null !== \Auth::user()->userProfile->icon)
                                                <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.\Auth::user()->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                                            @else
                                                <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                                            @endif
                                            <div class="info">
                                                <p class="name">{{Auth::user()->name}}</p>
                                                <p>【内容】希望は5000円なんですが、<br>5000円でお願いできませんか？</p>
                                            </div>
                                        </div>
                                        <p class="time">既読 2021年7月26日9:10</p>
                                    </li>


                                </ul>
                            </div>
                            <div class="item">
                                <div class="evaluation">
                                    <textarea placeholder="依頼する入力してください"></textarea>
                                </div>
                                <div class="btns">
                                    <a href="#">資料を添付する</a>
                                    <a href="#">定型分を使う</a>
                                </div>
                                <div class="about mt25">
                                    <p class="tit">【資料を添付する】について</p>
                                    <p>・テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>・テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
                                </div>
                                <div class="cancelTitle">
                                    <p>送信されたチャットを必要に応じてカリビト確認・削除することに同意し、</p>
                                </div>
                                <div class="functeBtns">
                                    <input type="submit" class="orange" value="送信する">
                                </div>
                            </div>
                            <div class="item">
                                <div class="about">
                                    <p class="danger">ご注意！</p>
                                    <p>・履歴を残すため、カリビト内でのやりとりを推奨しております。<br>・トラブルの際は 警察等の捜査依頼に積極的に協力しております 。<br>・直接お会いしての取引は、人目のつく場所か複数人で行いましょう。<br>・ 無断でキャンセル、公序良俗に反する行為、誹謗中傷などは利用停止となることがあります。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /#main -->
                <aside id="side" class="pc">
                    <div class="sideItem">
                        <p class="sideHd">掲載内容</p>
                        <div class="sideUl01">
                            <div class="publicate">
                                <div class="cont">
                                    @if(isset($product->productImage[0]))
                                        <p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path)}}" alt="" style="width: 75px;height: 62.5px;object-fit: cover;"></p>
                                    @else
                                        <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
                                    @endif
                                    <p class="txt">{{ $product->title }}</p>
                                </div>
                                <div class="amount">
                                    <p>希望報酬額</p>
                                    <p class="num">¥{{ number_format($product->price) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside><!-- /#side -->
            </div><!--inner-->
        </div><!-- /#contents -->
    </article>
</x-layout>