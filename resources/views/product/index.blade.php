<x-layout>
{{-- <article> --}}
    <div id="breadcrumb">
        <div class="inner">
            <a href="{{ route('home') }}">ホーム</a>　&gt;　
        </div>
                {{-- <a href="index.html">ホーム</a>　>　<a href="service.html">サービスを探す</a>　>　<span>デザイン</span> --}}
    </div>
    <article>
        <div id="teaser">
            <div class="inner">
                <h2>{{$category->name}}</h2>
            </div>
        </div><!-- /.teaser -->
        <div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
        <div id="contents">
            <div class="inner clearfix">
                <div class="titleStyle mt40 mb50">
                    {{-- <p class="sub">{{$category->detail}}かり</p> --}}
                    {{-- <p class="sub"></p>デザイン制作から印刷まで依頼ができるサービスです。チラシ、名刺、封筒、個展の案内状、ポストカードのデザイン、<br>商品を入れるパッケージや箱のデザインサービスも揃っています。<br>ノベルティや趣味で使うステッカーやシール、クリアファイルなどもデザイン制作から印刷まで依頼できます。</p> --}}
                </div>
                <div id="main">
                    <div class="cateList">
                        <h2 class="hdM">カテゴリ一覧</h2>
                        <div class="list sliderSP02">
                            @foreach ($child_categories as $child_category)
                                {{-- {{dd($child_categories)}} --}} dbに画像と詳細の文言を記入
                                <div class="item">
                                    <a href="#"><img src="img/service/img_service01.png" srcset="img/service/img_service01.png 1x, img/service/img_service01@2x.png 2x" alt="{{$child_category['name']}}">{{$child_category['name']}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="recommendList style2">
                        <h2 class="hdM">ランキング一覧</h2>
                        <div class="list sliderSP">
                            {{dd(1)}}
                            @foreach( $products as $product)
                            <div class="item">
                                <p class="level"></p>
                                <a href="{{route('product.show',$val->id)}}" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                    <img src="img/common/img_270x160.png" alt="">
                                    <button class="favorite">お気に入り</button>
                                </a>
                                <div class="info">
                                    <div class="breadcrumb">
                                        {{-- <a href="#">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp; --}}
                                        {{-- <span>{{ $val->mProductChildCategory->name }}</span> --}}
                                    </div>
                                    <div class="draw">
                                        <p class="price"><font>{{ $val->title }}</font><br>{{ number_format($val->price) }}円</p>
                                    </div>
                                    <div class="single">
                                        <span>単発リクエスト</span>
                                        <a href="#">対面</a>
                                    </div>
                                    <div class="aboutUser">
                                        <div class="user">
                                            <p class="ico"><img src="img/common/ico_head.png" alt=""></p>
                                            <div class="introd">
                                                <p class="name">クリエイター名</p>
                                                <p>(女性/ 20代/ 東京都)</p>
                                            </div>
                                        </div>
                                        <p class="check"><a href="#">本人確認済み</a></p>
                                        <div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
                                    </div>
                                </div>
                            </div>
										<h3 class="cateTit"><span>{{ $val->name }}</span><a href="#" class="more">{{ $val->name }}から探す</a></h3>
										<div class="list sliderSP">
											@foreach($products as $product)
												@if( $product->mProductChildCategory->mProductCategory->name === $val->name)
													<div class="item">
														<a href="{{route('product.show',$product->id)}}" class="img imgBox">
															@if(isset($product->productImage[0]))
																<p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path) }}" alt="" style="width: 192px;height: 160px;object-fit: cover;"></p>
																<button class="favorite">お気に入り</button>
															@else
																<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
																<button class="favorite">お気に入り</button>
															@endif
														</a>
														<div class="infoTop">
														<div>
															<div class="breadcrumb"><a href="#">{{ $product->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $product->mProductChildCategory->name }}</span></div>
															<div class="draw">
																<p class="price" style="width:100%"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
															</div>
															<div class="single">
																@if($product->is_online == App\Models\Product::OFFLINE)
																<a href="#">対面</a>
																@else
																<a href="#">非対面</a>
																@endif
															</div>



														</div>
															<div class="aboutUser">
																<div class="user">
																	@if(empty($product->user->userProfile->icon))
																	<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
																	@else
																	<p class="ico"><img src="{{asset('/storage/'.$product->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
																	@endif
																	<div class="introd">
																		<p class="name">{{ $product->user->name }}</p>
																		<p>({{ App\Models\UserProfile::GENDER[$product->user->userProfile->gender] }}/{{ $product->user->userProfile->birthday }} / {{ $product->user->userProfile->prefecture->name }})</p>
																	</div>
																</div>
																@if($product->user->userProfile->is_identify == App\Models\UserProfile::IS_IDENTIFY)
																<p class="check"><a href="#">本人確認済み</a></p>
																@endif
																<div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
															</div>
														</div>
													</div>
												@endif
											@endforeach
										</div>
									@endforeach
                           
                        </div>
                    </div>
                    {{-- @if () 検索時のみ表示する --}}
                        {{-- <div class="recommendList style2">
                            <h2 class="hdM">おすすめのお仕事</h2>
                            <div class="list sliderSP">
                                <div class="item">
                                    <a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                        <img src="img/common/img_270x160.png" alt="">
                                        <button class="favorite">お気に入り</button>
                                    </a>
                                    <div class="info">
                                        <div class="breadcrumb"><a href="#">デザイン</a>&emsp;＞&emsp;<span>その他デザイン</span></div>
                                        <div class="draw">
                                            <p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>
                                        </div>
                                        <div class="single">
                                            <span>単発リクエスト</span>
                                            <a href="#">対面</a>
                                        </div>
                                        <div class="aboutUser">
                                            <div class="user">
                                                <p class="ico"><img src="img/common/ico_head.png" alt=""></p>
                                                <div class="introd">
                                                    <p class="name">クリエイター名</p>
                                                    <p>(女性/ 20代/ 東京都)</p>
                                                </div>
                                            </div>
                                            <p class="check"><a href="#">本人確認済み</a></p>
                                            <div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    {{-- @endif --}}

                    <div class="recommendList style2">
                        <p class="cases">0,000 件中 1 - 40 件表示</p>
                        <div class="list sliderSP02">
                            <div class="item">
                                <a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                    <img src="img/common/img_270x160.png" alt="">
                                    <button class="favorite">お気に入り</button>
                                </a>
                                <div class="info">
                                    <div class="breadcrumb"><a href="#">デザイン</a>&emsp;＞&emsp;<span>その他デザイン</span></div>
                                    <div class="draw">
                                        <p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>
                                    </div>
                                    <div class="single">
                                        <span>単発リクエスト</span>
                                        <a href="#">対面</a>
                                    </div>
                                    <div class="aboutUser">
                                        <div class="user">
                                            <p class="ico"><img src="img/common/ico_head.png" alt=""></p>
                                            <div class="introd">
                                                <p class="name">クリエイター名</p>
                                                <p>(女性/ 20代/ 東京都)</p>
                                            </div>
                                        </div>
                                        <p class="check"><a href="#">本人確認済み</a></p>
                                        <div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                    <img src="img/common/img_270x160.png" alt="">
                                    <button class="favorite">お気に入り</button>
                                </a>
                                <div class="info">
                                    <div class="breadcrumb"><a href="#">デザイン</a>&emsp;＞&emsp;<span>その他デザイン</span></div>
                                    <div class="draw">
                                        <p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>
                                    </div>
                                    <div class="single">
                                        <span>単発リクエスト</span>
                                        <a href="#">対面</a>
                                    </div>
                                    <div class="aboutUser">
                                        <div class="user">
                                            <p class="ico"><img src="img/common/ico_head.png" alt=""></p>
                                            <div class="introd">
                                                <p class="name">クリエイター名</p>
                                                <p>(女性/ 20代/ 東京都)</p>
                                            </div>
                                        </div>
                                        <p class="check"><a href="#">本人確認済み</a></p>
                                        <div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                    <img src="img/common/img_270x160.png" alt="">
                                    <button class="favorite">お気に入り</button>
                                </a>
                                <div class="info">
                                    <div class="breadcrumb"><a href="#">デザイン</a>&emsp;＞&emsp;<span>その他デザイン</span></div>
                                    <div class="draw">
                                        <p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>
                                    </div>
                                    <div class="single">
                                        <span>単発リクエスト</span>
                                        <a href="#">対面</a>
                                    </div>
                                    <div class="aboutUser">
                                        <div class="user">
                                            <p class="ico"><img src="img/common/ico_head.png" alt=""></p>
                                            <div class="introd">
                                                <p class="name">クリエイター名</p>
                                                <p>(女性/ 20代/ 東京都)</p>
                                            </div>
                                        </div>
                                        <p class="check"><a href="#">本人確認済み</a></p>
                                        <div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                    <img src="img/common/img_270x160.png" alt="">
                                    <button class="favorite">お気に入り</button>
                                </a>
                                <div class="info">
                                    <div class="breadcrumb"><a href="#">デザイン</a>&emsp;＞&emsp;<span>その他デザイン</span></div>
                                    <div class="draw">
                                        <p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>
                                    </div>
                                    <div class="single">
                                        <span>単発リクエスト</span>
                                        <a href="#">対面</a>
                                    </div>
                                    <div class="aboutUser">
                                        <div class="user">
                                            <p class="ico"><img src="img/common/ico_head.png" alt=""></p>
                                            <div class="introd">
                                                <p class="name">クリエイター名</p>
                                                <p>(女性/ 20代/ 東京都)</p>
                                            </div>
                                        </div>
                                        <p class="check"><a href="#">本人確認済み</a></p>
                                        <div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=wp-pagenavi>
                            <span class="current">1</span>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">7</a>
                            ...
                            <a href="#" class="nextpostslink">次へ</a>
                        </div>
                    </div>
                </div><!-- /#main -->
                <aside id="side" class="pc">
                    <h2 class="cate cate02">デザインから探す</h2>
                    <ul class="links">
                        <li><a href="#">ロゴ</a></li>
                        <li><a href="#">チラシ・DM</a></li>
                        <li><a href="#">名刺</a></li>
                        <li><a href="#">メニュー表</a></li>
                        <li><a href="#">ポスター</a></li>
                        <li><a href="#">カタログ</a></li>
                        <li><a href="#">その他デザイン</a></li>
                    </ul>
                    <h2 class="cate cate03">並べ替え</h2>
                    <div class="checkboxChoice">
                        <label><input type=radio name=並べ替え>ランキングの高い順</label>
                        <label><input type=radio name=並べ替え>お気に入りの多い順</label>
                        <label><input type=radio name=並べ替え>新着順</label>
                    </div>
                    {{-- ボタン作る --}}
                    <h2 class="cate cate04">絞り込み</h2>
                    <div>
                        <table class="search">
                        <tr>
                            <th>エリア</th>
                            <td>
                                <select>
                                    <option>-</option>
                                    <option>1</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>金額</th>
                            <td class="elements"><input type="text" placeholder="指定なし">~<input type="text" placeholder="指定なし"></td>
                        </tr>
                        <tr>
                            <th>仕事体系</th>
                            <td>
                                <select>
                                    <option>-</option>
                                    <option>1</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>年代</th>
                            <td>
                                <select>
                                    <option>-</option>
                                    <option>1</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    </div>
                    <h2 class="cate cate05">その他サービスから探す</h2>
                    <ul class="other">
                        <li><a href="#" class="other01">家事</a></li>
                        <li><a href="#" class="other02">修理組み立て</a></li>
                        <li><a href="#" class="other03">ペット</a></li>
                        <li><a href="#" class="other04">高齢者向け</a></li>
                        <li><a href="#" class="other05">乗り物</a></li>
                        <li><a href="#" class="other06">引越し</a></li>
                        <li><a href="#" class="other07">趣味・習い事</a></li>
                        <li><a href="#" class="other08">美容・ファッション</a></li>
                        <li><a href="#" class="other09">写真動作制作</a></li>
                        <li><a href="#" class="other10">その他</a></li>
                        <li><a href="#" class="other11">インテリア</a></li>
                        <li><a href="#" class="other12">デザイン</a></li>
                        <li><a href="#" class="other13">パソコン</a></li>
                        <li><a href="#" class="other14">ビジネスサポート</a></li>
                        <li><a href="#" class="other15">冠婚葬祭</a></li>
                        <li><a href="#" class="other16">料理</a></li>
                        <li><a href="#" class="other17">恋愛・結婚</a></li>
                        <li><a href="#" class="other18">体験・アクティビティ</a></li>
                        <li><a href="#" class="other19">出張サービス</a></li>
                    </ul>
                </aside><!-- /#side -->
            </div><!--inner-->
        </div><!-- /#contents -->
    </article>
</x-layout>