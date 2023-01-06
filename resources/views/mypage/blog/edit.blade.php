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
						<form action="{{ route('blog.update', $blog) }}" method="post" idform enctype="multipart/form-data">
							@csrf
							@method('PATCH')
							<div class="mypageEditBox">
								<div class="mypageEditList">
									<p class="mypageEditHd">タイトル</p>
									@error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="mypageEditInput">
										<input type="text" name="title" placeholder="タイトルを入力してください" value="{{ old('title', $request->title ?? "") }}{{ $blog->title }}" required>
									</div>
								</div>
								<div class="mypageEditList">
									<p class="mypageEditHd">投稿する内容をご記入ください</p>
									@error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="mypageEditInput">
										<textarea name="content" placeholder="投稿する内容を入力してください" required>{{ old('content', $request->content ?? "") }}{{ $blog->content }}</textarea>
									</div>
								</div>
								<div class="mypageEditList">
									<p class="mypageEditHd">出品サービス</p>
									@error('product_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="mypageEditInput">
										<select class="middle_ipt" name="product_id" required>
											@foreach (App\Models\Product::loginUsers()->notDraft()->orderBy('created_at','desc')->get() as $key => $product)
												<option value="{{ $key }}" @if( old('product_id', $blog->product_id) == $key) selected @endif>
													{{ $product->title }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="fancyPersonBtn">
									<a href="{{ route('blog.index') }}" class="fancyPersonCancel">キャンセル</a>
									<button class="fancyPersonSign loading-disabled">更新する</button>
								</div>
							</div>
						</form>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!--contents-->
	<x-hide-modal/>
</x-layout>