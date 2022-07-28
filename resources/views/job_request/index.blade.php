<x-layout :keyword="$keyword ?? ''" :serviceflg="$service_flg ?? ''">
	<div id="breadcrumb">
		<div class="inner">
			<a href="{{ route('home') }}">ホーム</a>　&gt;
            @if (isset($parent_category_flg))
                @if ($parent_category_flg === 1)
                    <a href="{{ route('job_request.category.index', $category->id) }}">{{$category->name}}</a>
                @elseif ($parent_category_flg === 0)
                    <a href="{{ route('job_request.category.index', $child_category->mProductCategory->id) }}">{{$child_category->mProductCategory->name}}</a>　&gt;　
                    <a href="{{ route('job_request.category.index.show', $child_category->id) }}">{{$child_category->name}}</a>
                @endif
            @else
                <a>検索結果一覧</a>
            @endif
		</div>
	</div><!-- /.breadcrumb -->

	<article>
		<div id="teaser">
			<div class="inner">
				<h2>{{$title}}</h2>
			</div>
		</div><!-- /.teaser -->
		<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

		<div id="contents">
			<div class="inner clearfix">
				@if (isset($parent_category_flg))
                    <div class="titleStyle mt40 mb50">
                        {{-- <p class="sub">{{$category->detail}}仮、説明文が入る</p> --}}
                        <p class="sub"></p>デザイン制作から印刷まで依頼ができるサービスです。チラシ、名刺、封筒、個展の案内状、ポストカードのデザイン、<br>商品を入れるパッケージや箱のデザインサービスも揃っています。<br>ノベルティや趣味で使うステッカーやシール、クリアファイルなどもデザイン制作から印刷まで依頼できます。</p>
                    </div>
                @endif
				<div id="main">
					<div class="cateList">
						@if (isset($parent_category_flg))
                            <h2 class="hdM">カテゴリ一覧</h2>
                            <div class="list sliderSP02">
                                @if ($parent_category_flg === 1)
                                    @foreach ($child_categories as $child_category)
                                    {{-- dbに画像と詳細の文言を記入 --}}
                                        <div class="item">
                                            <a href="{{ route('job_request.category.index.show', $child_category->id) }}"><img src="img/service/img_service01.png" srcset="img/service/img_service01.png 1x, img/service/img_service01@2x.png 2x" alt="{{$child_category['name']}}">{{$child_category['name']}}</a>
                                        </div>
                                    @endforeach
                                @elseif ($parent_category_flg === 0)
                                    @foreach ($all_child_categories as $all_child_category)
                                    {{-- dbに画像と詳細の文言を記入 --}}
                                        <div class="item">
                                            <a href="{{ route('job_request.category.index.show', $all_child_category->id) }}"><img src="img/service/img_service01.png" srcset="img/service/img_service01.png 1x, img/service/img_service01@2x.png 2x" alt="{{$all_child_category->name}}">{{$all_child_category['name']}}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
					</div>

					@if (isset($parent_category_flg) && $parent_category_flg === 1)
						<div class="recommendList style2">
							<h2 class="hdM">ランキング一覧</h2>
							<div class="list sliderSP"> {{--st3クラスを消した。横幅がおかしかったため--}}
								@foreach( $job_request_ranks as $job_request_rank)
									<div class="item">
										<p class="level"></p>
										<div class="info biggerlink">
											<div class="breadcrumb">
												<a href="{{ route('job_request.category.index', $job_request_rank->mProductChildCategory->mProductCategory->id) }}">
													{{ $job_request_rank->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;
												<a href="{{ route('job_request.category.index.show', $job_request_rank->mProductChildCategory->id) }}">
													{{ $job_request_rank->mProductChildCategory->name }}</a>
											</div>
											<a href="{{route('job_request.show',$job_request_rank->id)}}">
												<div class="draw">
													<p class="price">{{ $job_request_rank->title }}</p>
												</div>
												<div class="budget">
													<table>
														<tr>
															<th><span class="th">予算</span></th>
															<td>{{ number_format($job_request_rank->price) }}円〜</td>
														</tr>
														<tr>
															<th><span class="th">提案数</span></th>
															<td>0</td>
															{{-- まだわからない --}}
														</tr>
														<tr>
															<th><span class="th">募集期限</span></th>
															<td>{{ $job_request_rank->deadline_day }}日と{{ $job_request_rank->deadline_hour }}時間</td>
															{{-- 修正する --}}
															{{-- <td>{{ $job_request_rank->application_deadline }}</td> --}}
														</tr>
													</table>
												</div>
											</a>
											<div class="aboutUser">
												<div class="user">
													@if(empty($job_request_rank->user->userProfile->icon))
														<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
													@else
														<p class="ico"><img src="{{asset('/storage/'.$job_request_rank->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
													@endif
													<div class="introd">
														<p class="name">{{ $job_request_rank->user->name }}</p>
														<p>({{ App\Models\UserProfile::GENDER[$job_request_rank->user->userProfile->gender] }}/{{ $job_request_rank->user->userProfile->birthday }} / {{ $job_request_rank->user->userProfile->prefecture->name }})</p>
													</div>
												{{-- <p class="check"><span>本人確認済み</span></p>
												<div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div> --}}
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					@endif

					{{-- @if (!isset($parent_category_flg))
						<div class="recommendList style2">
							<h2 class="hdM">おすすめのお仕事</h2>
							<div class="list sliderSP st3">
								<div class="item">
									<div class="info biggerlink">
										<div class="breadcrumb"><span>デザイン</span>&emsp;＞&emsp;<span>その他デザイン</span></div>
										<div class="draw">
											<p class="price"><a href="request_detail.html">似顔絵イラスト描きます</a></p>
										</div>
										<div class="budget">
											<table>
												<tr>
													<th><span class="th">予算</span></th>
													<td>5,000円〜</td>
												</tr>
												<tr>
													<th><span class="th">提案数</span></th>
													<td>0</td>
												</tr>
												<tr>
													<th><span class="th">募集期限</span></th>
													<td>1日と10時間</td>
												</tr>
											</table>
										</div>
										<div class="aboutUser">
											<div class="user">
												<p class="ico"><img src="img/common/ico_head.png" alt=""></p>
												<div class="introd">
													<p class="name">クリエイター名</p>
													<p>(女性/ 20代/ 東京都)</p>
												</div>
											</div>
											<p class="check"><span>本人確認済み</span></p>
											<div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif --}}

					<div class="recommendList style2">
						<p class="cases">{{$job_requests->total()}}件中
							{{  ($job_requests->currentPage() -1) * $job_requests->perPage() + 1}} - {{ (($job_requests->currentPage() -1) * $job_requests->perPage() + 1) + (count($job_requests) -1)  }}件の表示
                            {{-- <h3 class="col-7 col-md-9 mb-0 h3">商品一覧（{{$job_requests->total() . '件中' . $job_requests->firstItem() . '-' . $job_requests->lastItem()}}件）</h3> --}}
						</p>
						<div class="list sliderSP02">　{{--st3クラスを消した。横幅がおかしかったため--}}
							@foreach( $job_requests as $job_request)
								<div class="item">
									<div class="info biggerlink">
										<div class="breadcrumb">
											<a href="{{ route('job_request.category.index', $job_request->mProductChildCategory->mProductCategory->id) }}">
												{{ $job_request->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;
											<a href="{{ route('job_request.category.index.show', $job_request->mProductChildCategory->id) }}">
												{{ $job_request->mProductChildCategory->name }}</a>
										</div>
										<div class="draw">
											<p class="price">
												<a href="{{route('job_request.show',$job_request->id)}}">{{ $job_request->title }}</a>
											</p>
										</div>
										<div class="budget">
											<table>
												<tr>
													<th><span class="th">予算</span></th>
													<td>{{ number_format($job_request->price) }}円〜</td>
												</tr>
												<tr>
													<th><span class="th">提案数</span></th>
													<td>0</td>
												</tr>
												<tr>
													<th><span class="th">募集期限</span></th>
													<td>{{ $job_request->deadline_day }}日と{{ $job_request->deadline_hour }}時間</td>
												</tr>
											</table>
										</div>
										<div class="aboutUser">
											<div class="user">
												@if(empty($job_request_rank->user->userProfile->icon))
													<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
												@else
													<p class="ico"><img src="{{asset('/storage/'.$job_request_rank->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
												@endif
												<div class="introd">
													<p class="name">{{ $job_request->user->name }}</p>
													<p>({{ App\Models\UserProfile::GENDER[$job_request->user->userProfile->gender] }}/{{ $job_request->user->userProfile->birthday }} / {{ $job_request->user->userProfile->prefecture->name }})</p>
												</div>
											{{-- <p class="check"><span>本人確認済み</span></p>
											<div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div> --}}
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
					<div class=wp-pagenavi>
						{{ $job_requests->links() }}
					</div>
				</div><!-- /#main -->
				<aside id="side">
					<h2 class="cate cate02">
						@if (isset($parent_category_flg))
                            @if ($parent_category_flg === 1)
                                {{$category->name}}から探す</h2>
                            @elseif ($parent_category_flg === 0)
                                {{$child_category->mProductCategory->name}}から探す</h2>
                            @endif
                        @endif
					</h2>
					<ul class="links">
						@if (isset($parent_category_flg))
                            @if ($parent_category_flg === 1)
                                @foreach ($child_categories as $child_category)
                                    <li><a href="show/{{ $child_category->id }}">{{$child_category->name}}</a></li>
                                @endforeach
                            @elseif ($parent_category_flg === 0)
                                @foreach ($all_child_categories as $all_child_category)
                                    {{-- <li><a href="show/{{ $all_child_category->id }}">{{$all_child_category->name}}</a></li> --}}
                                    <li><a href="{{route('job_request.category.index.show', $all_child_category->id) }}">{{$all_child_category->name}}</a></li>
                                @endforeach
                            @endif
                        @endif
					</ul>
					<form method="get" class="" enctype="multipart/form-data" action="{{ route('product.search') }}">
						<h2 class="cate cate03">並べ替え</h2>
						<div class="checkboxChoice">
							<label><input type="radio" name="sort" value="1" @if (isset($sort) && $sort === '1') checked @endif>ランキングの高い順</label>
							<label><input type="radio" name="sort" value="2" @if (isset($sort) && $sort === '2') checked @endif>お気に入りの多い順</label>
							<label><input type="radio" name="sort" value="3" @if (isset($sort) && $sort === '3') checked @endif>新着順</label>
						</div>
						<h2 class="cate cate04">絞り込み</h2>
						<div>
							<table class="search">
								<tr>
									<th>エリア</th>
									<td>
										<select name="prefecture_id">
											<option value="">-</option>
											@foreach($prefectures as $prefecture)
												<option value="{{ $prefecture->id }}" @if(isset($prefecture_id) && $prefecture_id == $prefecture->id) selected @endif>{{ $prefecture->name }}</option>
											@endforeach
										</select>
									</td>
								</tr>
								<tr>
									<th>金額</th>
									<td class="elements"><input type="text" name="low_price" placeholder="指定なし" @if(isset($low_price)) value="{{$low_price}}" @endif>~<input type="text" name="high_price" placeholder="指定なし" @if(isset($high_price)) value="{{$high_price}}" @endif></td>
								</tr>
								<tr>
									<th>仕事体系</th>
									<td>
										<select name="is_online">
											<option value="">-</option>
											<option value="{{App\Models\Product::OFFLINE}}" @if(isset($is_online) && $is_online === (string)App\Models\Product::OFFLINE) selected @endif>対面</option>
											<option value="{{App\Models\Product::ONLINE}}" @if(isset($is_online) && $is_online === (string)App\Models\Product::ONLINE) selected @endif>非対面</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>年代</th>
									<td>
										<select name="age_period">
											<option value="">-</option>
											@foreach(App\Libraries\Age::AGE_PERIOD as $key => $value)
												<option value="{{ $key }}" @if (isset($age_period) && $age_period == $key) selected @endif>
													{{ $value }}
												</option>
											@endforeach
										</select>
									</td>
								</tr>
							</table>
							@if (isset($parent_category_flg))
								@if ($parent_category_flg === 1)
									<input type="hidden" name="parent_category_flg" value="1">
									<input type="hidden" name="parent_category_id" value="{{ $category->id}}">
								@elseif ($parent_category_flg === 0)
									<input type="hidden" name="parent_category_flg" value="0">
									<input type="hidden" name="parent_category_id" value="{{ $child_category->mProductCategory->id}}">
									{{-- 連続で検索するとカテゴリーがなくなる --}}
									<input type="hidden" name="child_category_id" value="{{ $child_category->id}}">
								@endif
							@endif

							{{-- 検索の時 --}}
							@if (isset($child_category_id))
								<input type="hidden" name="child_category_id" value="{{$child_category_id}}">
							@elseif (isset($parent_category_id))
								<input type="hidden" name="parent_category_id" value="{{$parent_category_id}}">
							@endif
							@if (isset($keyword))
								<input type="hidden" name="keyword" value="{{$keyword}}">
							@endif
							<input type="hidden" name="service_flg" value="2">
							<input type="submit" class="blue-button mb20" style="margin-left: 0" formaction="{{ route('product.search') }}" value="検索する">
						</div>
					</form>
					<h2 class="cate cate05">その他サービスから探す</h2>
					<ul class="other">
						@foreach($categories as $category)
							<li><a href="{{route('job_request.category.index', $category->id) }}" class="other{{$loop->iteration}}">{{ $category->name }}</a></li>
						@endforeach
					</ul>
				</aside><!-- /#side -->
				{{-- <div id="Wrap">
					<div class="beginGuide">
						<h2 class="hdM">初めての方へ</h2>
						<ul>
							<li><a href="#"><img src="img/common/img_guide01.png" srcset="img/common/img_guide01.png 1x, img/common/img_guide01@2x.png 2x" alt=""></a></li>
							<li><a href="#"><img src="img/common/img_guide02.png" srcset="img/common/img_guide02.png 1x, img/common/img_guide02@2x.png 2x" alt=""></a></li>
						</ul>
					</div>
				</div> --}}
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
<script type="text/javascript">
$(function(){
	$( "#datepicker" ).datepicker();
});
</script>

