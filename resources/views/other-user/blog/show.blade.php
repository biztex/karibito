<x-other-user.layout>
	<article>
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
								{{ $blog->content }}
							</div>
							<div class="recommendList style2 blogDtList">
								<div class="list sliderSP02">
									<div class="item">
										<a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
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
												@if($blog->product->is_online == App\Models\Product::OFFLINE)
													<span>対面</span>
												@else
													<span>非対面</span>
												@endif
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
								<li><a href="#"><img src="img/mypage/ico_facebook.svg" alt=""></a></li>
								<li><a href="#"><img src="img/mypage/ico_line.svg" alt=""></a></li>
								<li><a href="#"><img src="img/mypage/ico_twitter.svg" alt=""></a></li>
								<li><a href="#"><img src="img/mypage/ico_mail.svg" alt=""></a></li>
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
									@if(\Auth::user())
                                        @if(App\Models\UserFollow::IsFollowing($user->id))
                                            <a href="{{ route('follow.sub', ['id' => $user->id]) }}" class="followB" onclick='return confirm("フォローを解除しますか？");'>フォロー済み</a>
                                        @else
                                            <a href="{{ route('follow.add', ['id' => $user->id]) }}" class="followA">フォローする</a>
                                        @endif
                                    @else
                                        <a href="{{ route('follow.add', ['id' => $user->id]) }}" class="followA">フォローする</a>
                                    @endif
                                    @if(empty($dmrooms))
                                        <a href="{{ route('dm.create',$user->id) }}">メッセージを送る</a>
                                    @else
                                        <a href="{{ route('dm.show',$dmrooms->id) }}">メッセージを送る</a>
                                    @endif
								</div>
							</div>
							<p class="blogAll"><a href="{{ route('user.blog', $user->id) }}">一覧へ戻る</a></p>
						</div>
					</div>
				</div><!-- /#main -->
                @include('other-user.parts.side')
            </div><!--inner-->
        </div><!-- /#contents -->
	</article>
</x-other-user.layout>
