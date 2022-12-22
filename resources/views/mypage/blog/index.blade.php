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
					<div class="blogWrap">
						<p class="mypageHd02"><span>ブログ</span></p>
						<div class="blogAdd">
							<a href="{{ route('blog.create') }}"><img src="img/mypage/edit_blog.svg" alt="ブログを追加"></a>
						</div>
						@foreach ($blogs as $blog)
							<div class="blogItem">
								<p class="blogItemImg">
									<a href="{{ route('blog.show', $blog) }}"><img src="{{ $blog->path }}" alt=""></a>
								</p>
								<p class="blogItemHd">{{ $blog->title }}</p>
								<p class="blogItemBread">
									<a href="{{ route('product.category.index', $blog->product->mProductChildCategory->mProductCategory->id) }}">
										{{ $blog->product->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
									<a href="{{ route('product.category.index.show', $blog->product->mProductChildCategory->id)}}">
										{{ $blog->product->mProductChildCategory->name }}</a>
								</p>
								<div class="blogItemCont">
									<p>{{ $blog->content }}</p>
								</div>
								<dl class="blogItemPerson">
									@if(empty($blog->user->userProfile->icon))
										<dt><img src="/img/mypage/pic_head.png" alt=""></dt>
									@else
										<dt><img src="{{asset('/storage/' . $blog->user->userProfile->icon) }}" alt=""></dt>
									@endif
									<dd>
										<p class="nameP">{{ $blog->user->name }}</p>
										<p class="dateP">{{ $blog->updated_at }}</p>
									</dd>
								</dl>
								<div>
									<p class="specialtyBtn addBtn02"><a href="{{ route('blog.edit', $blog) }}"><img src="img/mypage/icon_edit.svg" alt="">ブログを編集</a></p>
									<form id="delete-blog" class="report_btn" action="{{ route('blog.destroy', $blog) }}" method="post">
										@csrf
										@method('DELETE')
										<button type="button" class="delete js-alertModal">削除</button>
									</form>
								</div>
							</div>
						@endforeach
					</div>
				</div><!-- /#main -->
				<x-side-menu/>

				<x-parts.alert-modal phrase="このブログを削除しますか？" formId="delete-blog" />
			</div><!--inner-->
		</div><!--contents-->
		</div><!--blog-->
	<x-hide-modal/>
</x-layout>