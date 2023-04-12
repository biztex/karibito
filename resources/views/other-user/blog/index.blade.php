<x-other-user.layout>
	<article class="other-user-blog">
		<div class="otherNav">
			<div class="inner">
				<ul>
					<li><a href="{{ route('user.mypage', $user->id) }}">ホーム</a></li>
					<li><a href="{{ route('user.evaluation', $user->id) }}">評価</a></li>
					<li><a href="{{ route('user.skills', $user->id) }}">スキル・経歴</a></li>
					<li><a href="{{ route('user.portfolio', $user->id) }}">ポートフォリオ</a></li>
					<li><a href="{{ route('user.publication', $user->id) }}">出品サービス</a></li>
					<li><a href="" class="is_active">ブログ</a></li>
				</ul>
			</div>
		</div>

		<x-parts.post-button/>
        <x-parts.flash-msg/>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="blogWrap">
						<p class="mypageHd02"><span>ブログ</span></p>
						@if ($blogs->isEmpty())
							<p>ブログはありません。</p>
						@else
							@foreach ($blogs as $blog)
								<div class="blogItem">
									<p class="blogItemImg">
										<a href="{{ route('user.blog.show', [$user, $blog]) }}"><img src="{{ $blog->path }}" alt=""></a>
									</p>
									<p class="blogItemHd">{{ $blog->title }}</p>
									<p class="blogItemBread">
										<a href="{{ route('product.category.index', $blog->product->mProductChildCategory->mProductCategory->id) }}">
											{{ $blog->product->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
										<a href="{{ route('product.category.index.show', $blog->product->mProductChildCategory->id)}}">
											{{ $blog->product->mProductChildCategory->name }}</a>
									</p>
									<a href="{{ route('user.blog.show', [$user, $blog]) }}">
										<div class="blogItemCont">
											<p>{!! $blog->content !!}</p>
										</div>
										<dl class="blogItemPerson">
											@if(empty($blog->user->userProfile->icon))
												<dt><img src="/img/mypage/no_image.jpg" alt=""></dt>
											@else
												<dt><img src="{{asset('/storage/' . $blog->user->userProfile->icon) }}" alt=""></dt>
											@endif
											<dd>
												<p class="nameP">{{ $blog->user->name }}</p>
												<p class="dateP">{{ $blog->updated_at }}</p>
											</dd>
										</dl>
									</a>
								</div>
							@endforeach
						@endif
					</div>
				</div><!-- /#main -->
				@include('other-user.parts.side')
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-other-user.layout>
