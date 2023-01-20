<x-layout :keyword="$keyword ?? ''" :serviceflg="$service_flg ?? ''">
<x-parts.post-button/>
	<div id="breadcrumb">
		<div class="inner">
			<a href="{{ route('home') }}">ホーム</a>　&gt;
            @if (isset($parent_category_flg))
                @if ($parent_category_flg === 1)
                    <a href="{{ route('blog.category.index', $category->id) }}">{{$category->name}}</a>
                @elseif ($parent_category_flg === 0)
                    <a href="{{ route('blog.category.index', $child_category->mProductCategory->id) }}">{{$child_category->mProductCategory->name}}</a>　&gt;　
                    <a href="{{ route('blog.category.index.show', $child_category->id) }}">{{$child_category->name}}</a>
                @endif
            @else
                <a>検索結果一覧</a>
            @endif
		</div>
	</div><!-- /.breadcrumb -->
	<x-parts.ban-msg/>

	<article>
		<div id="teaser">
			<div class="inner">
				<h2>{{$title}}</h2>
			</div>
		</div><!-- /.teaser -->

		<div id="contents">
			<div class="inner clearfix">
				<div id="main">
					<div class="cateList">
						@if (isset($parent_category_flg) && $parent_category_flg === 1)
                            <h2 class="hdM">カテゴリ一覧</h2>
                            <div class="list sliderSP02">
                                @if ($parent_category_flg === 1)
                                    @foreach ($child_categories as $child_category)
                                    {{-- dbに画像と詳細の文言を記入 --}}
                                        <div class="item">
                                            <a href="{{ route('blog.category.index.show', $child_category->id) }}"><img src="img/service/img_service01.png" srcset="img/service/img_service01.png 1x, img/service/img_service01@2x.png 2x" alt="{{$child_category['name']}}">{{$child_category['name']}}</a>
                                        </div>
                                    @endforeach
                                @elseif ($parent_category_flg === 0)
                                    @foreach ($all_child_categories as $all_child_category)
                                    {{-- dbに画像と詳細の文言を記入 --}}
                                        <div class="item">
                                            <a href="{{ route('blog.category.index.show', $all_child_category->id) }}"><img src="img/service/img_service01.png" srcset="img/service/img_service01.png 1x, img/service/img_service01@2x.png 2x" alt="{{$all_child_category->name}}">{{$all_child_category['name']}}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
					</div>

					<div class="recommendList style2">
						<p class="cases">{{$blogs->total()}}件中
							{{  ($blogs->currentPage() -1) * $blogs->perPage() + 1}} - {{ (($blogs->currentPage() -1) * $blogs->perPage() + 1) + (count($blogs) -1)  }}件の表示
						</p>
						<div class="list sliderSP02">{{--st3クラスを消した。横幅がおかしかったため--}}
							@foreach($blogs as $blog)
								<x-parts.blog-item :blog='$blog'/>
							@endforeach
						</div>
					</div>
					<div class=wp-pagenavi>
						{{ $blogs->links() }}
					</div>
				</div><!-- /#main -->
				<aside id="side" class="pc">
					<h2 class="cate cate02">
						@if (isset($parent_category_flg))
                            @if ($parent_category_flg === 1)
                                {{$category->name}}から探す</h2>
                            @elseif ($parent_category_flg === 0)
                                {{$child_category->mProductCategory->name}}から探す</h2>
                            @endif
                        @endif
					<ul class="links">
						@if (isset($parent_category_flg))
                            @if ($parent_category_flg === 1)
                                @foreach ($child_categories as $child_category)
                                    <li><a href="show/{{ $child_category->id }}">{{$child_category->name}}</a></li>
                                @endforeach
                            @elseif ($parent_category_flg === 0)
                                @foreach ($all_child_categories as $all_child_category)
                                    {{-- <li><a href="show/{{ $all_child_category->id }}">{{$all_child_category->name}}</a></li> --}}
                                    <li><a href="{{route('blog.category.index.show', $all_child_category->id) }}">{{$all_child_category->name}}</a></li>
                                @endforeach
                            @endif
                        @endif
					</ul>
					{{-- ▼▼▼ ランキング・お気に入りなどの機能がブログにないので下記の検索機能をコメントアウト ▼▼▼ --}}
					{{-- <form method="get" class="" enctype="multipart/form-data" action="{{ route('product.search') }}">
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
											@foreach(App\Models\Prefecture::all() as $prefecture)
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
							<div class="checkboxChoice">
								<label><input type="checkbox" name="is_sale" value="1" @if (isset($is_sale) && $is_sale === '1') checked @endif>販売中</label>
							</div>
							@if (isset($parent_category_flg))
								@if ($parent_category_flg === 1)
									<input type="hidden" name="parent_category_flg" value="1">
									<input type="hidden" name="parent_category_id" value="{{ $category->id}}">
								@elseif ($parent_category_flg === 0)
									<input type="hidden" name="parent_category_flg" value="0">
									<input type="hidden" name="parent_category_id" value="{{ $child_category->mProductCategory->id}}">
									{{-- 連続で検索するとカテゴリーがなくなる --}}
									{{-- <input type="hidden" name="child_category_id" value="{{ $child_category->id}}">
								@endif
							@endif --}}

							{{-- 検索の時 --}}
							{{-- @if (isset($child_category_id))
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
					</form> --}}
					{{-- ▲▲▲ 検索機能上記ここまで ▲▲▲ --}}
					<h2 class="cate cate05">その他サービスから探す</h2>
					<ul class="other">
						@foreach(App\Models\MProductCategory::all() as $category)
							<li><a href="{{route('blog.category.index', $category->id) }}" class="other{{$loop->iteration}}">{{ $category->name }}</a></li>
						@endforeach
					</ul>
				</aside><!-- /#side -->
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
<script type="text/javascript">
$(function(){
	$( "#datepicker" ).datepicker();
});
</script>

