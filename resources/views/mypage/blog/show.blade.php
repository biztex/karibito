<x-layout>
	<x-parts.post-button/>
	<div id="blog">
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>ブログ</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>
		<x-parts.flash-msg/>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="blogDtWrap">
						<div class="">
							<p class="blogItemImg"><img src="{{ $blog->path }}" alt=""></p>
							<p class="blogItemHd">{{ $blog->title }}</p>
							<p class="blogItemBread">
								<a href="{{ route('product.category.index', $blog->product->mProductChildCategory->mProductCategory->id) }}">
									{{ $blog->product->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
								<a href="{{ route('product.category.index.show', $blog->product->mProductChildCategory->id)}}">
									{{ $blog->product->mProductChildCategory->name }}</a>
							</p>
							<dl class="blogItemPerson">
								<dt><img src="img/blog/head_detail01_01.png" alt=""></dt>
								<dd>
									<p class="nameP">{{ $blog->user->name }}</p>
									<p class="dateP">{{ $blog->updated_at }}</p>
								</dd>
							</dl>
							<div class="blogItemCont">
								{!! $blog->content !!}
							</div>
							<div class="recommendList style2 blogDtList">
								<div class="list sliderSP02">
									<div class="item">
										<a href="{{ route('product.show',$blog->product_id) }}" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
											<img src="img/common/img_270x160.png" alt="">
											<button class="favorite">お気に入り</button>
										</a>
										<div class="info">
											<div class="breadcrumb">
												<a href="{{ route('product.category.index', $blog->product->mProductChildCategory->mProductCategory->id) }}">
													{{ $blog->product->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
												<a href="{{ route('product.category.index.show', $blog->product->mProductChildCategory->id)}}">
													{{ $blog->product->mProductChildCategory->name }}</a>
											</div>
											<div class="draw">
												<p class="price"><font>{{ $blog->product->title }}</font><br>{{ number_format($blog->product->price) }}円</p>
											</div>
											<div class="single">
												<span>{{App\Models\Product::IS_ONLINE[$blog->product->is_online]}}</span>
											</div>
											<div class="aboutUser">
												<div class="user" style="margin-bottom:6px;">
													@if(empty($blog->product->user->userProfile->icon))
														<a href="{{ route('user.mypage', $blog->product->user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
													@else
														<a href="{{ route('user.mypage', $blog->product->user_id) }}" class="ico"><img src="{{asset('/storage/'.$blog->product->user->userProfile->icon) }}" alt=""></a>
													@endif
													<div class="introd">
														<p class="name word-break">{{ $blog->product->user->name }}</p>
														<p>({{ App\Models\UserProfile::GENDER[$blog->product->user->userProfile->gender] }}/ {{ $blog->product->user->userProfile->age }}/ {{ $blog->product->user->userProfile->prefecture->name }})</p>
													</div>
												</div>
												<x-parts.evaluation-star :star='$blog->product->user->avg_star'/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<ul class="detailSns">
                                <li><a href="http://www.facebook.com/share.php?u={{ $url }}"><img src="/img/mypage/ico_facebook.svg" alt=""></a></li>
                                <li><a href="https://social-plugins.line.me/lineit/share?url={{ $url }}"><img src="/img/mypage/ico_line.svg" alt=""></a></li>
                                <li><a href="https://twitter.com/share?url={{ $url }}&text={{ $blog->title }} %20%7C%20 {{ $blog->user->name }} %20%7C%20ブログ %20%7C%20 カリビト&hashtags=karibito" target="_blank"><img src="/img/mypage/ico_twitter.svg" alt=""></a></li>
                                <li><a href="mailto:?subject=カリビトのブログをシェア&body={{ $blog->title }} %20%7C%20 {{ $blog->user->name }} %20%7C%20ブログ %20%7C%20 カリビト {{ $url }}" target="_blank"><img src="/img/mypage/ico_mail.svg" alt=""></a></li>
                            </ul>
							<div class="blogDtOther">
								<dl class="blogItemPerson">
									<dt><img src="img/blog/head_detail01_01.png" alt=""></dt>
									<dd>
										<p class="nameP">{{ $blog->user->name }}</p>
										<p class="dateP">({{ App\Models\UserProfile::GENDER[$blog->product->user->userProfile->gender] }}/ {{ $blog->product->user->userProfile->age }}/ {{ $blog->product->user->userProfile->prefecture->name }})</p>
									</dd>
								</dl>
								<div class="blogDtOtherBtn">
									@if ($blog->user->id === Auth::user()->id)
										<a href="{{ route('blog.edit', $blog) }}" class="followA">編集する</a>
										<form id="delete-blog" class="report_btn" action="{{ route('blog.destroy', $blog) }}" method="post">
											@csrf
											@method('DELETE')
											<button type="submit" class="delete js-alertModal">削除する</button> {{--todo:デザイン崩れ、アラートでない--}}
										</form>
									@else
										@if(empty($dmrooms))
											<a href="{{ route('dm.create',$blog->user->id) }}" class="followA">メッセージを送る</a>
										@else
											<a href="{{ route('dm.show',$dmrooms->id) }}" class="followA">メッセージを送る</a>
										@endif
										@if(App\Models\UserFollow::IsFollowing($blog->user->id))
											<form id="follow-sub-form" action="{{ route('follow.sub', ['id' => $blog->user->id]) }}" method="get">
												@csrf
												<a type="button" class="followB js-alertModal" style="cursor: pointer">フォロー済み</a>
											</form>
										@else
											<a href="{{ route('follow.add', ['id' => $blog->user->id]) }}" class="followA">フォローする</a> {{--デザイン修正--}}
										@endif
									@endif
								</div>
							</div>
							<p class="blogAll"><a href="{{ route('blog.index') }}">一覧へ戻る</a></p>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!--contents-->
	</div><!--blog-->
<x-hide-modal/>
<x-parts.alert-modal phrase="フォローを解除してもよろしいですか？" value="フォロー解除" formId="follow-sub-form" />
<x-parts.alert-modal phrase="このブログを削除しますか？" formId="delete-blog" />
</x-layout>